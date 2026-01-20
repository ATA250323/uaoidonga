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
    public $motdepassehasher;

public function __construct(User $user, $motdepassehasher)
{
    $this->user = $user;
    $this->motdepassehasher = $motdepassehasher;

}


    public function build()
    {
        return $this->subject(__('traduction.message_inscription.subject2'))
                    ->view('emails.inscriptionuser',[
                                        'motdepassehasher'=>$this->motdepassehasher,
                                    ]);
    }

}

