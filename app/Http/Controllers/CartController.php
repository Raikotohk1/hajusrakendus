<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        return response()->json($cart);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }

    public function cart()
    {
        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $quantity = $request->input('amount');

        $product = Bicycle::where('id', $product_id)->firstOrFail();
        $cartItems = session()->get('cart', []);

        // Check if the item already exists in the cart
        $itemIndex = -1;
        foreach ($cartItems as $index => $item)
        {
            if ($item['product_id'] == $product_id)
            {
                $itemIndex = $index;
                break;
            }
        }

        // If the item exists in the cart, update its quantity
        if ($itemIndex !== -1)
        {
            $cartItems[$itemIndex]['quantity'] += $quantity;
        }
        else
        {
            $cartItems[] = [
                'product_id' => $product_id,
                'name' => $product['name'],
                'quantity' => $quantity,
                'price' => $product['price']
            ];
        }

        session()->put('cart', $cartItems);

        return redirect()->back()->with('success', 'Item added to cart successfully.');
    }

    public function showCart()
    {
        //session()->forget('coupon');
        $cartItems = session('cart', []);

        $total = 0;
        $coupon = session('coupon');
        //dd($coupon->coupon_id);
        if ($coupon)
        {
            $total -= $coupon->discount;// Calculate discount based on coupon rules;
        }

        // Process payment

        foreach ($cartItems as $item)
        {
            // Cast price and quantity to float to ensure numeric values
            $price = (float)$item['price'];
            $quantity = (int)$item['quantity'];

            // Add the product's price multiplied by its quantity to the total
            $total += $price * $quantity;
        }
        //dd(session('cart'));
        return view('cart', compact('cartItems', 'total'));
    }
    public function removeFromCart($index)
        {
            $cart = session()->get('cart');
            unset($cart[$index]);
            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Item removed from cart successfully.');
        }

    public function updateCartItem(Request $request, $index)
    {
        $quantity = $request->input('quantity');
        $cartItems = session()->get('cart', []);

        if ($cartItems[$index]['name'] === 'coupon' && $quantity > 1)
        {
            $quantity = 1;
        }

        if (isset($cartItems[$index]))
        {
            $cartItems[$index]['quantity'] = $quantity;
            session()->put('cart', $cartItems);
        }

        return redirect()->route('cart')->with('success', 'Cart item updated successfully.');
    }

}
