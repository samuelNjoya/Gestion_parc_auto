<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;

class RappelEntretienNotification extends Notification
{
    use Queueable;

    protected $entretien;

    public function __construct($entretien)
    {
        $this->entretien = $entretien;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $date = Carbon::parse($this->entretien->prochaine_date);
        // Récupération du véhicule lié
        $vehicule = $this->entretien->getVehicule;

        return (new MailMessage)
            ->subject('Rappel : Entretien à venir')
            ->greeting('Bonjour Mr '.$notifiable->nom.',')
            ->line('Vous avez un entretien programmé pour le véhicule '.$vehicule->marque.' (matricule : '.$vehicule->immatriculation.') le '.$date->format('d/m/Y').'.')
            ->line('Merci de prendre les dispositions nécessaires.')
            ->salutation('Cordialement,');
    }
}
