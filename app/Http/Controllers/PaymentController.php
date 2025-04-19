<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    public function createCheckoutSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'customer_email' => $request->user()->email, // o el correo del usuario
            'line_items' => [[
                'price_data' => [
                    'currency' => 'mxn',
                    'product_data' => [
                        'name' => 'Reserva de medio publicitario',
                    ],
                    'unit_amount' => $request->total * 100, // En centavos
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('checkout.success') . '?reserva_id=' . $request->reserva_id,
            'cancel_url' => route('checkout.cancel'),
        ]);
        logger($session->url);

        return response()->json(['url' => $session->url]);
    }
}
