<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Factura extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $productos_factura;
    public $destino;

    public function __construct($productos_factura,$destino)
    {
        $this->productos_factura=$productos_factura;
        $this->destino=$destino;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');
        return $this->view('facturas.email-factura')
                    ->from("sistema_ventas@gmail.com")
                    ->subject("Nuevo mensaje de Sistema de ventas a ".$this->destino);
    }
}
