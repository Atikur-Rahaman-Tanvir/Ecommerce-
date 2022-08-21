<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class orderPlaceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $placeOrder;
    public $order_summery;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($placeOrder, $order_summery)
    {
         $this->placeOrder = $placeOrder;
         $this->order_summery = $order_summery;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $from_name = "Tanvir IT";
        $from_email = "tanvir@gmail.com";
        $subject = "Place Order Confirmaiton";
        return $this->from($from_email, $from_name)->subject($subject)->view('email.placeOrder');
    }
}
