<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\InterventionTechModel;
use Carbon\Carbon;

class EnvoyerRappelsEntretien extends Command
{
    protected $signature = 'rappels:entretien';  // Signature de la commande (nom utilisé avec php artisan rappels:entretien)

    protected $description = 'Envoyer des notifications 3 jours avant la prochaine date d’entretien'; //Description de la commande afficher dans php artisan list

    public function handle()
    {
        $dateCible = Carbon::now()->addDays(3)->startOfDay();

        // $entretiens = InterventionTechModel::whereDate('prochaine_date', $dateCible)->get();
        $entretiens = InterventionTechModel::whereDate('prochaine_date', $dateCible)
                       ->with('getVehicule') // Charger vehicule et gestionnaire
                       ->get();


        foreach ($entretiens as $entretien) {
            $gestionnaire = $entretien->getGestionnaireReceiptMail; // relation User
            $vehicule = $entretien->getVehicule; // relation vehicule


            if ($gestionnaire) {
                $gestionnaire->notify(new \App\Notifications\RappelEntretienNotification($entretien));
                $this->info("Notification envoyée à {$gestionnaire->email} pour l'entretien  {$entretien->titre}  d'ID {$entretien->id} du vehicule {$vehicule->marque}-{$vehicule->immatriculation}");
            }
        }
    }
}
