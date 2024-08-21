<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CorreoElectronico extends Mailable
{
    use Queueable, SerializesModels;

    public $empleado;
    public $productos;
    public $sucursal;

    public function __construct($empleado, $producto, $sucursal)
    {
        $this->empleado = $empleado;
        $this->productos = $producto;
        $this->sucursal = $sucursal;
    }

    public function build()
    {
        return $this->view('emails.inventarioEscaso')
                    ->subject('Producto Limitado')
                    ->with([
                        'empleado' => $this->empleado,
                        'productos' => $this->productos,
                        'sucursal' => $this->sucursal,
                    ]);
    }
}
