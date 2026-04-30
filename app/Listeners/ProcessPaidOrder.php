<?php
namespace App\Listeners;
use App\Events\OrderPaid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
class ProcessPaidOrder
{
    public function __construct()
    {
    }
    public function handle(OrderPaid $event): void
    {
        $order = $event->order;
        foreach ($order->items as $item) {
            if ($item->product) {
                $item->product->decrement('stock', $item->quantity);
            }
        }
    }
}
