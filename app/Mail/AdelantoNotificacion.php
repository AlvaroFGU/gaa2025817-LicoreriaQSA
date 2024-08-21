<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdelantoNotificacion extends Mailable
{
    use Queueable, SerializesModels;
    public $adelanto;
    public $empleado;

    public function __construct($adelanto, $empleado)
    {
        $this->adelanto = $adelanto;
        $this->empleado = $empleado;
    }

   
    public function build()
    {
        return $this->subject('Nuevo Adelanto Creado')
                    ->view('emails.AdelantoNotificacion')
                    ->with([
                        'empleado' => $this->empleado,
                        'adelanto' => $this->adelanto
                    ]);
    }

    
    
}
