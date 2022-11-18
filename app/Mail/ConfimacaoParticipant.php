<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfimacaoParticipant extends Mailable
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

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject('Chamada para votação de meet');
        $this->to($this->participant->email);
        return $this->view('user.mails.participants',[
            'uuid' => $this->participant->uuid
        ]);
    }

}
