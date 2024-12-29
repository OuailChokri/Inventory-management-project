<?php


namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientMail extends Mailable
{
    use Queueable, SerializesModels;

    public $client;
    public $messageContent;

    public function __construct($client, $messageContent)
    {
        $this->client = $client;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('GS')->view('emails.client');
    }
}
