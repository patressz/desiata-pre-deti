<?php

namespace App\Http\Controllers;

use Stripe\Payout;
use Stripe\Stripe;
use App\Models\User;
use Stripe\Customer;
use App\Models\Payment;
use App\Models\Product;
use Stripe\StripeClient;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use App\Notifications\Invoice;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
        return view('add-credit');
    }

    public function pay(PaymentRequest $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $stripe = new StripeClient(env('STRIPE_SECRET'));

        $customer = $stripe->customers->create([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'metadata' => [
                'user_id' => auth()->id(),
                'payment_id' => 0,
                'order_status' => 1,
            ],
        ]);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                  'name' => 'Kredit',
                ],
                'unit_amount' => $request->amount * 100,
              ],
              'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => url('/') . "/payment/checkout?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => url('/') . "/payment/checkout?session_id={CHECKOUT_SESSION_ID}",
            'expires_at' => time() + (3600),
            'customer' => $customer->id,
        ]);

        return redirect($session->url, 303);
    }

    public function add_credit(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $session = Session::retrieve($request->session_id);
        $customer = $stripe->customers->retrieve($session->customer);

        if ( $session && $session->payment_status === "paid" && $session->status === "complete" && $customer->metadata->user_id == auth()->id() && $customer->metadata->order_status == 1 ) {
            $user = User::findOrFail(auth()->id());

            $user->update([
                'money' => $user->money + ($session->amount_total * 0.01)
            ]);

            $payment = Payment::create([
                'user_id' => $user->id,
                'user_name' => $user->name,
                'stripe_id' => $session->payment_intent,
                'amount' => $session->amount_total * 0.01,
            ]);

            $stripe->customers->update(
                $session->customer,
                [
                    'metadata' => [
                        'order_status' => 2,
                        'payment_id' => $payment->id,
                    ],
                ],
            );

           $user->notify(new Invoice($user, $session, $payment));

            if ( $request->session()->get('url') ) {
                $url = $request->session()->get('url');
                $request->session()->forget('url');

                return redirect($url);
            }

            return redirect()->route('payment.add.credit')->withStatus(new HtmlString("Transakcia bola úspešná, Váš kredit bol navýšený o <strong>" . $session->amount_total * 0.01 . " &euro; </strong>" ));
        } else {
            return redirect()->route('payment.add.credit')->withErrors('Transakcia nebola úspešná.');
        }
    }

    public function payments()
    {
        return view('admin.payments');
    }

}
