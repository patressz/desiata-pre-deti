<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrdersExport implements FromView, ShouldAutoSize
{
    public $date;

    public function __construct($date)
    {
        $this->date = Carbon::parse($date)->format('Y-m-d');
    }

    public function view(): View
    {
        $orders = Order::whereNotNull('child_id')->where('status', 0)->where('date', $this->date)->with('child')->with('product')->orderBy('created_at')->get()->groupBy('product_id');

        return view('admin.export', [
            "orders" => $orders,
        ]);
    }
}
