<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use App\Models\Contactetablissement;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inscriptionuser extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
   public $user;
public $confirmationCode;
public $motdepassehasher;
public $etablissement;
public $contactEtablissement;

public function __construct(User $user, $confirmationCode, $motdepassehasher)
{
    $this->user = $user;
    $this->confirmationCode = $confirmationCode;
    $this->motdepassehasher = $motdepassehasher;

    // 🔥 Récupérer l’établissement du user via la pivot table
    $this->etablissement = $user->etablissement()->first();

    // 🔥 Récupérer les infos ContactEtablissement via slug
    if ($this->etablissement && $this->etablissement->slug) {
        $this->contactEtablissement = Contactetablissement::where(
            'slug',
            $this->etablissement->slug
        )->first();
    }
}


    public function build()
    {
        return $this->subject(__('traduction.message_inscription.subject2').' '.$this->etablissement->nomarabe.' '.$this->etablissement->nomfrancais)
                    ->view('emails.inscriptionuser',[
                                        'confirmationCode'=>$this->confirmationCode,
                                        'motdepassehasher'=>$this->motdepassehasher,
                                    ]);
    }

}

