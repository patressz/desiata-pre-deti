<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    private $now;
    private $today;
    private $monday;
    private $thursday;
    private $friday;
    private $saturday;
    private $sunday;
    private $twooclock;
    private $week_days = [];

    public function __construct()
    {
        $this->authorizeResource(Order::class, 'order');

        $this->now = Carbon::now();
        $this->today = Carbon::today();
        $this->monday = Carbon::now()->startOfWeek();
        $this->thursday = Carbon::parse('thursday');
        $this->friday = Carbon::parse('friday');
        $this->saturday = Carbon::parse('saturday');
        $this->sunday = Carbon::parse('sunday');
        $this->twooclock = Carbon::createFromFormat('H:i:s', DB::table('settings')->where('name', 'deadline')->value('value'));

        if ( $this->today->eq( $this->thursday ) && $this->now->gt($this->twooclock) || $this->today->eq( $this->friday ) || $this->today->eq( $this->saturday ) || $this->today->eq( $this->sunday ) ) {
            if ( $this->today->eq( $this->sunday ) || $this->today->eq( $this->saturday ) ) {
                $this->monday = $this->friday->startOfWeek();
            } else {
                $this->monday = $this->friday->nextWeekDay();
            }
        }

        $this->week_days = [
            'Pondelok' => $monday = $this->monday,
            'Utorok' => $tuesday = $monday->copy()->addDay(),
            'Streda' => $wednesday = $tuesday->copy()->addDay(),
            'Štvrtok' => $thursday = $wednesday->copy()->addDay(),
            'Piatok' => $friday = $thursday->copy()->addDay(),
            'Sobota' => $saturday = $friday->copy()->addDay(),
            'Nedeľa' => $sunday = $saturday->copy()->addDay(),
        ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date)
    {
        $orders = Order::whereNotNull('child_id')->where('user_id', auth()->id())->where('date', $date)->with('child')->with('product')->orderBy('created_at')->get()->groupBy('product_id');
        $date = Carbon::parse( $date )->format('Y-m-d H:i:s');

        return view('my-orders')->with([
           'orders' => $orders,
           'date' => $date,
           'week_days' => $this->week_days,
           'today' => $this->today,
           'now' => $this->now,
           'twooclock' => $this->twooclock,
        ]);
    }

    /**
     * Show the calendar for selecting date.
     *
     * @return \Illuminate\Http\Response
     */
    public function select_date(Request $request)
    {
        $childrens = Auth()->user()->childrens;
        if ( $childrens->count() == 0 ) {
            $request->session()->put('url', url()->current() . "?product_id=$request->product_id");

            return redirect()->route('childrens.index')->withErrors('Najprv musíte pridať dieťa!');
        }

        $product = Product::findOrFail($request->product_id);

        if ( auth()->user()->money < $product->price ) {
            $request->session()->put('url', url()->current() . "?product_id=$request->product_id");

            return redirect()->route('payment.home')->withErrors('Nemáte dostatok kreditov!');
        }

        return view('order-step-1')->with([
            'today' => $this->today,
            'now' => $this->now,
            'twooclock' => $this->twooclock,
            'week_days' => $this->week_days,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $childrens = Auth()->user()->childrens;
        $product = Product::where('id', $request->product_id)->first();

        return view('order-step-2', compact('childrens', 'product') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ( Carbon::parse($request->date)->format('l') == "Saturday" || Carbon::parse($request->date)->format('l') == "Sunday") {
            return redirect()->route('products')->withErrors('Niečo sa pokazilo, skúste to znova.');
        }

        if ( $this->today == Carbon::parse('sunday') && $request->date == $this->week_days['Pondelok'] && $this->now->gt( $this->twooclock ) ) {
            return redirect()->route('products')->withErrors('Niečo sa pokazilo, skúste to znova.');
        }

        if ( Carbon::parse( $request->date )->gt( $this->today ) && Carbon::parse( $request->date )->ne( $this->today ) && Carbon::parse( $request->date )->ne( Carbon::tomorrow() ) ) {

            $product = Product::findOrFail($request->product_id);

            if ( auth()->user()->money < $product->price ) {
                return redirect()->route('payment.home')->withErrors('Nemáte dostatok kreditov!');
            } else {

                Order::create([
                    'user_id' => auth()->id(),
                    'child_id' => $request->child_id,
                    'product_id' => $request->product_id,
                    'date' => $request->date,
                ]);

                User::where('id', auth()->id())->update([
                    'money' => auth()->user()->money - $product->price,
                ]);

                return redirect()->route('orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne odoslaná.');
            }

        } elseif ( Carbon::parse( $request->date )->eq( Carbon::tomorrow() ) && $this->now->lt( $this->twooclock ) ) {

            $product = Product::findOrFail($request->product_id);

            if ( auth()->user()->money < $product->price ) {
                return redirect()->route('payment.home')->withErrors('Nemáte dostatok kreditov!');
            } else {

                Order::create([
                    'user_id' => auth()->id(),
                    'child_id' => $request->child_id,
                    'product_id' => $request->product_id,
                    'date' => $request->date,
                ]);

                User::where('id', auth()->id())->update([
                    'money' => auth()->user()->money - $product->price,
                ]);

                return redirect()->route('orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne odoslaná.');
            }
        } else {
            return redirect()->route('products')->withErrors('Niečo sa pokazilo, skúste to znova.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        if ( $this->today == Carbon::parse('sunday') && Carbon::parse($order->date)->format('Y-m-d H:i:s') == $this->week_days['Pondelok'] && $this->now->gt( $this->twooclock ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        }

        $order_date = Carbon::parse($order->date)->format('Y-m-d H:i:s');
        $childrens = Auth()->user()->childrens;

        if ( $this->today->lt( $order_date ) && $this->today->ne( $order_date ) && Carbon::tomorrow()->ne( $order_date ) ) {
            return view('edit-order', compact('order', 'childrens') );
        } elseif ( Carbon::tomorrow()->eq( $order_date ) && $this->now->lt( $this->twooclock ) ) {
            return view('edit-order', compact('order', 'childrens') );
        } elseif ( Carbon::tomorrow()->eq( $order_date ) && $this->now->gt( $this->twooclock ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        } elseif ( $this->today->ne( $order_date ) && $this->today->gt( $order_date ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Objednávku nie je možné zmazať!');
        } elseif ( $this->today->eq( $order_date ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        if ( $this->today == Carbon::parse('sunday') && Carbon::parse($order->date)->format('Y-m-d H:i:s') == $this->week_days['Pondelok'] && $this->now->gt( $this->twooclock ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        }

        $order_date = Carbon::parse($order->date)->format('Y-m-d H:i:s');

        if ( $this->today->lt( $order_date ) && $this->today->ne( $order_date ) && Carbon::tomorrow()->ne( $order_date ) ) {

            $order->update([
                'child_id' => $request->child_id,
            ]);

            return redirect()->route('orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne upravená.');
        } elseif ( Carbon::tomorrow()->eq( $order_date ) && $this->now->lt( $this->twooclock ) ) {

            $order->update([
                'child_id' => $request->child_id,
            ]);

            return redirect()->route('orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne upravená.');
        } elseif ( Carbon::tomorrow()->eq( $order_date ) && $this->now->gt( $this->twooclock ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        } elseif ( $this->today->ne( $order_date ) && $this->today->gt( $order_date ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Objednávku nie je možné zmazať!');
        } elseif ( $this->today->eq( $order_date ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ( $this->today == Carbon::parse('sunday') && Carbon::parse($order->date)->format('Y-m-d H:i:s') == $this->week_days['Pondelok'] && $this->now->gt( $this->twooclock ) ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Niečo sa pokazilo, skúste to znova.');
        }

        if ( $order->status == 1 ) {
            return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Objednávku so statusom \'doručená\' nie je možné zmazať!');
        } else {
            $order_date = Carbon::parse($order->date)->format('Y-m-d H:i:s');

            if ( $this->today->lt( $order_date ) && $this->today->ne( $order_date ) && Carbon::tomorrow()->ne( $order_date ) ) {

                $user = User::findOrFail(auth()->id());
                $user->update([
                    'money' => $user->money + $order->product->price,
                ]);

                $order->delete();

                return redirect()->route('orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne zmazaná.');
            } elseif ( Carbon::tomorrow()->eq( $order_date ) && $this->now->lt( $this->twooclock ) ) {

                $user = User::findOrFail(auth()->id());
                $user->update([
                    'money' => $user->money + $order->product->price,
                ]);

                $order->delete();

                return redirect()->route('orders.index', now()->format('Y-m-d'))->withStatus('Objednávka bola úspešne zmazaná.');
            } elseif ( Carbon::tomorrow()->eq( $order_date ) && $this->now->gt( $this->twooclock ) ) {
                return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Objednávku nie je možné zmazať!');
            } elseif ( $this->today->ne( $order_date ) && $this->today->gt( $order_date ) ) {
                return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Objednávku nie je možné zmazať!');
            } elseif ( $this->today->eq( $order_date ) ) {
                return redirect()->route('orders.index', now()->format('Y-m-d'))->withErrors('Objednávku nie je možné zmazať!');
            }
        }
    }
}
