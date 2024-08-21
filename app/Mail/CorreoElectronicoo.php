<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoElectronico extends Mailable
{
    use Queueable, SerializesModels;

    public $codigoSeguridad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($codigoSeguridad)
    {
        $this->codigoSeguridad = $codigoSeguridad;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('passwords.reset') // Cambiar a la vista correcta
                    ->with('codigoSeguridad', $this->codigoSeguridad)
                    ->subject('Código de Verificación');
    }
}
