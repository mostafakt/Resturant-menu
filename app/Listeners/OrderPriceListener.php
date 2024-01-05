<?php

namespace App\Listeners;

use App\Events\AddProductToOrderEvent;

class OrderPriceListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AddProductToOrderEvent  $event
     * @return void
     */
    public function handle(AddProductToOrderEvent $event)
    {
        $order = $event->order;
        $order->calculatePrices();

    }
}
