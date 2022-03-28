<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class AllOrders extends Component
{
    public $date;
    public $status;

    public function render()
    {
        $admin_orders = Order::whereNotNull('child_id')->where('date', $this->date)->with('child')->with('product')->orderBy('created_at')->get()->groupBy('product_id');

        return view('livewire.all-orders', [
            "orders" => $admin_orders,
        ]);
    }

    public function update_status($id)
    {
        $order = Order::where('id', $id)->first();

        if ( $order->status == 0 ) {
            $order->update([
                'status' => 1,
            ]);
        } elseif ( $order->status == 1 ) {
            $order->update([
                'status' => 0,
            ]);
        }
    }
}
