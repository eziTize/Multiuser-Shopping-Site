<?php
$o_products = \App\OrderProduct::where('order_id', $order->id)->get();
?>
@component('mail::message')
    # Order Received

    Thank you for your order.

    **Transaction ID:** {{ $order->transaction_id }}

    **Order Email:** {{ $order->email }}

    **Customer Name:** {{ $order->user->name }}

    **Order Total:** Rs. {{ number_format($order->amount, 2) }}

    **Items Ordered**

    @foreach ($o_products as $o_p)
    Name: {{ $o_p->product->name }}
    Price: Rs. {{ number_format($o_p->product->price, 2)}}
    Quantity: {{ $o_p->quantity }}
    Product Image:
    ![product]({{asset($o_p->product->image)}})

    @endforeach

    You can get further details about your order by logging into our website.
    Go to Website: {{ url('/')}}

    Thank you again for choosing us.

    Regards,
    Team {{ config('app.name') }}
@endcomponent