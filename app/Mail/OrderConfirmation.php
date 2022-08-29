<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $products;
    public $subtotalCZK;
    public $subtotalEUR;
    public $postageCZK;
    public $postageEUR;

    public function __construct($products, $subtotalCZK, $subtotalEUR, $postageCZK, $postageEUR)
    {
        $this->products = $products;
        $this->subtotalCZK = $subtotalCZK;
        $this->subtotalEUR = $subtotalEUR;
        $this->postageCZK = $postageCZK;
        $this->postageEUR = $postageEUR;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.orders.confirmation');
    }
}
