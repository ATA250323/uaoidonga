<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\App;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class Inscription extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    // public $motdepasse;
    public $confirmationCode;
    public function __construct(User $user ,$confirmationCode)
    {
        //
        $this->user = $user;
        // $this->motdepasse = $motdepasse;
        $this->confirmationCode = $confirmationCode ;
        // $this->confirmationCode = url('/confirmation/'.$confirmationCode);
    }

    public function build()
    {
        return $this->subject(__('traduction.message_inscription.subject'))
                    ->view('emails.inscription',[
                                        'confirmationCode'=>$this->confirmationCode,
                                    ]);
    }

}

