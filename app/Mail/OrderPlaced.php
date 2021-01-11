<?php

namespace App\Mail;

use App\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;
    public $order;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //return $this->view('view.name');

        return $this->from('acenterprise.co.in@gmail.com', 'AC Enterprise')
            ->to($this->order->email, $this->order->user->name)
            //->bcc('jackteny@gmail.com')
            ->bcc('sandipan21saha@yahoo.com')
            ->subject('Order Placed at AC Enterprise')
            //->with(['message' => $this])
            ->markdown('emails.order_placed');
    }
}
