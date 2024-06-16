<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class StripePaymentController extends Controller
{

    public function stripe()
    {
        // Fetch cart items from session
        $cart = session()->get('cart');
        
        // Calculate total amount
        $total = 0;
        foreach ($cart as $id => $details) {
            $total += $details['price'] * $details['quantity'];
        }

        $product = [
            'name' => 'Bicycle Shop Purchase',
            'description' => 'Items from your shopping cart',
            'price' => $total, // Total amount from the cart
        ];

        return view('stripe', compact('product'));
    }

    public function stripeCheckout(Request $request)
    {
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));

        // Prepare cart items from session
        $cart = session()->get('cart');
        $lineItems = [];
        foreach ($cart as $id => $details) {
            $lineItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $details['name'],
                    ],
                    'unit_amount' => $details['price'] * 100, // Convert to cents
                    'currency' => 'USD',
                ],
                'quantity' => $details['quantity'],
            ];
        }

        $redirectUrl = route('stripe.checkout.success') . '?session_id={CHECKOUT_SESSION_ID}';
        $response = $stripe->checkout->sessions->create([
            'success_url' => $redirectUrl,
            'cancel_url' => route('cart'), // Redirect back to cart if payment is canceled
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'allow_promotion_codes' => false
        ]);

        return redirect($response['url']);
    }

    public function stripeCheckoutSuccess(Request $request)
    {
        $stripe = new \Stripe\StripeClient(Config::get('stripe.stripe_secret_key'));

        $session = $stripe->checkout->sessions->retrieve($request->session_id);
        info($session);

        // Clear the cart after successful payment
        session()->forget('cart');

        $successMessage = "Payment successful. Your order ID is " . $session->payment_intent;

        return view('success', compact('successMessage'));
    }
}
