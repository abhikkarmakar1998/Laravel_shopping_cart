<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function session(Request $request) 
    {
        $productItems = [];

        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        foreach(session('cart') as $id => $details) {

            $product_name = $details['product_name'];
            $total = $details['price'];
            $quantity = $details['quantity'];

            $two0 = "00";
            $unit_amount = "$total$two0";
            
            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency' => 'USD',
                    'unit_amount' => $unit_amount,
                ],
                'quantity' => $quantity
                
            ];

        }       

        $checkoutSession = \Stripe\Checkout\Session::create([
            'line_items'            => [$productItems],
            'mode'                  => 'payment',
            'allow_promotion_codes' => true,
            'metadata'              => [
                'user_id' =>"0001"
            ],
            'customer_email' => "cairocoders-ednalang@gmail.com",
            'success_url' => route('success'),
            'cancel_url' => route('cancel'),
        ]);

        return redirect()->away($checkoutSession->url);
    }

    public function success()
    {
        return "Thanks for order you have completed your payment, The seeler will reach out to you as soon as possible.";   
    }

    public function cancel()
    {
        return view('cancel');   
    }
}
