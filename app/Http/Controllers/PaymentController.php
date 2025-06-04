<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Full Access Subscription',
                    ],
                    'unit_amount' => 1000,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('payment.success'),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success()
    {
        // Логика успешного платежа
    }

    public function cancel()
    {
        // Логика отмены платежа
    }
}
