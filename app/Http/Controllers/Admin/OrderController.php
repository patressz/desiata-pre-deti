<?php

namespace App\Http\Controllers\Admin;

use Throwable;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $date)
    {
        $date = Carbon::parse( $date )->format('Y-m-d H:i:s');

        return view('admin.all-orders')->with([
           'date' => $date,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $admin_order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $admin_order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $admin_order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $admin_order)
    {
       //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $admin_order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $admin_order)
    {
       //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $admin_order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $admin_order)
    {
        $user = User::findOrFail( $admin_order->user->id );

        $user->update([
            'money' => $user->money + $admin_order->product->price,
        ]);

        $admin_order->delete();

        return redirect()->route('admin-orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne zmazaná.');
    }

    public function export($date)
    {
        $date = Carbon::parse($date)->format('d-m-Y');

        try {
            return Excel::download(new OrdersExport($date), "objednavky-$date.pdf");
        } catch (Throwable) {
            return redirect()->route('admin-orders.index', now()->format('Y-m-d'))->withErrors('Export objednávok na tento deň nie je možný!');
        }
    }
}
