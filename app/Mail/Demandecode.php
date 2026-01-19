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

class Demandecode extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $user;
    // public $motdepasse;
    public $code;
    public function __construct(User $user ,$code)
    {
        //
        $this->user = $user;
        // $this->motdepasse = $motdepasse;
        $this->code = $code ;
    }

    public function build()
    {
        return $this->subject(__('traduction.codeconf'))
                    ->view('emails.demandecode',[
                                        'code'=>$this->code,
                                        'user'=>$this->user,
                                    ]);
    }

}
