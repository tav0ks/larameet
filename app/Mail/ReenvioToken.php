<?php

namespace App\Mail;

use App\Models\Meet;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReenvioToken extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Instance of user
     *
     *
     * @var \App\Models\User
     */

     protected $participant;

     /**
      * Create a new message instance.
      *
      * @return void
      */
     public function __construct(User $participant)
     {
         $this->participant = $participant;
     }

    public function build()
    {
        $meet = Meet::find($this->participant->meet_id);
        $this->subject('Reenvio Token');
        $this->to($this->participant->email);
        return $this->view('user.mails.participants',[
            'uuid' => $this->participant->uuid,
            'meet' => $meet
        ]);
    }
}
