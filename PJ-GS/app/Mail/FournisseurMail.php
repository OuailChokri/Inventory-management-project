<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

// app/Mail/FournisseurMail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FournisseurMail extends Mailable
{
    use Queueable, SerializesModels;

    public $fournisseur;
    public $messageContent;

    public function __construct($fournisseur, $messageContent)
    {
        $this->fournisseur = $fournisseur;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Sujet de l\'email')->view('emails.fournisseur');
    }
}
