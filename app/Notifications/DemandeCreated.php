<?php

namespace App\Notifications;

use App\Models\Demande;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DemandeCreated extends Notification implements ShouldQueue
{
    use Queueable;

    public $demande;

    /**
     * Create a new notification instance.
     */
    public function __construct(Demande $demande)
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
        return (new MailMessage)
            ->subject('Création de la demande')
            ->greeting('Bonjour ' . $this->demande->demandeur->name)
            ->line('Votre demande d’analyse du dossier numéro #' . $this->demande->id . ' a bien été prise en compte.')
            ->line('Status: En cours d’analyse')
            ->action('Voir la demande', url('/demandes/' . $this->demande->id))
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
