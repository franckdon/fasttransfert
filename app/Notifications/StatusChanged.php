<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusChanged extends Notification implements ShouldQueue
{
    use Queueable;

    public $demande;

    /**
     * Create a new notification instance.
     */
    public function __construct($demande)
    {
        $this->demande = $demande;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $status = $this->demande->historiques->last()->status;

        if ($status === 'approuvée') {
            $message = 'Votre demande d’analyse du dossier numéro #' . $this->demande->id . ' est éligible au guichet de la BCEAO. La version PDF sera transmise à votre banque pour présentation.';
        } else {
            $message = 'Votre dossier numéro #' . $this->demande->id . ' a été rejetée. Besoin d’assistance, prière de contacter l’équipe contact@kfm-consulting.com. Le dossier sera supprimé sous 7 jours.';
        }
        return (new MailMessage)
            ->line('Changement de status de votre demande.')
            ->greeting('Bonjour ' . $this->demande->demandeur->name)
            ->line($message)
            ->line('Merci d’utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
