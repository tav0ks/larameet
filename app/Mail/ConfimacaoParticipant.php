<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfimacaoParticipant extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Instance of participant
     * 
     * 
     * @var \App\Models\Participant
     */

    protected $participant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant)
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
