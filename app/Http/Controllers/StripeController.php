<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Stripe\Webhook;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {
        $user = auth()->user();

        Stripe::setApiKey(env('STRIPE_SECRET'));
        $session = Session::create([
            'customer_email' => $user->email,
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => ['name' => 'Wallet Recharge'],
                    'unit_amount' => $request->amount * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('welcome'),
            'cancel_url' => route('welcome'),
            'metadata' => ['user_id' => $user->id, 'amount' => $request->amount * 100]
        ]);
        return redirect($session->url);
    }

    public function handle(Request $request)
    {

        $payload = $request->getContent();
        // Log::info($request->header());
        Log::info('Stripe Event:', ['event' => $payload]);

        // return $payload;
        $sig = $request->header('Stripe-Signature');
        Log::info("sadfasf");
        try {
            $event = Webhook::constructEvent(
                $payload,
                $sig,
                env('STRIPE_WEBHOOK_SECRET')
            );

            Log::info('Stripe Event:', ['event' => $event]);
        } catch (\Exception $e) {
            Log::info("test", ["dsf" => $e]);
            return response()->json(['error' => $e->getMessage()], 400);
        }
        if ($event->type === 'checkout.session.completed') {

            // NOTE: Mark order as paid or process payment here
        }

        return response()->json(['status' => 'ok']);
    }
}
