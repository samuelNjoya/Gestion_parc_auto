<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Carbon;

class RappelExpirationDocNotification extends Notification
{
    use Queueable;

    protected $expirationdoc;

    public function __construct($expirationdoc)
    {
        $this->expirationdoc = $expirationdoc;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $date = Carbon::parse($this->expirationdoc->date_expiration);
        // Récupération du véhicule lié
        $vehicule = $this->expirationdoc->getVehicule;
        $type_doc = $this->expirationdoc->type;

        return (new MailMessage)
            ->subject('Rappel : Expiration du Document à venir')
            ->greeting('Bonjour Mr '.$notifiable->nom.',')
            ->line('Le document '.$type_doc.' du véhicule '.$vehicule->marque.' (matricule : '.$vehicule->immatriculation.') s\'expire le '.$date->format('d/m/Y').'.')
            ->line('Merci de prendre les dispositions nécessaires.')
            ->salutation('Cordialement,');
    }
}
