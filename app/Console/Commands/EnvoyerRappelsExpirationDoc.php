<?php

namespace App\Console\Commands;

use App\Models\DocumentVehiculeModel;
use Illuminate\Console\Command;
use Carbon\Carbon;

class EnvoyerRappelsExpirationDoc extends Command
{
    protected $signature = 'rappels:expirationdoc';  // Signature de la commande (nom utilisé avec php artisan rappels:expirationdoc)

    protected $description = 'Envoyer des notifications 3 jours avant la prochaine date d’expirationdoc'; //Description de la commande afficher dans php artisan list

    public function handle()
    {
        $dateCible = Carbon::now()->addDays(3)->startOfDay();

        // $expirationdocs = InterventionTechModel::whereDate('prochaine_date', $dateCible)->get();
        $expirationdocs = DocumentVehiculeModel::whereDate('date_expiration', $dateCible)
                       ->with('getVehicule') // Charger vehicule et gestionnaire
                       ->get();


        foreach ($expirationdocs as $expirationdoc) {
            $gestionnaire = $expirationdoc->getGestionnaireReceiptMail; // relation User
            $vehicule = $expirationdoc->getVehicule; // relation vehicule


            if ($gestionnaire) {
                $gestionnaire->notify(new \App\Notifications\RappelExpirationDocNotification($expirationdoc));
                $this->info("Notification envoyée à {$gestionnaire->email} pour l'expiration du document  {$expirationdoc->type}  d'ID {$expirationdoc->id} du vehicule {$vehicule->marque}-{$vehicule->immatriculation}");
            }
        }
    }
}
