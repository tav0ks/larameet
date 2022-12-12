<?php

namespace App\Mail;

use App\Models\Horario;
use App\Models\Meet;
use App\Models\Participant;
use App\Models\Topic;
use App\Models\User;
use Dompdf\Dompdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeetEncerrado extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $participant;
    protected $most_voted;

    public function __construct(User $participant, $most_voted)
    {
        $this->participant = $participant;
        $this->most_voted = $most_voted;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Meet Encerrado',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'user.mails.meetEncerrado',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {

        return [
            Attachment::fromData(fn () => $this->pdf,'Report.pdf')->withMime('mail/pdf'),
        ];
    }
}
