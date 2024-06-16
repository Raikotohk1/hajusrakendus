<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Http\Request;

class BicycleController extends Controller
{
    public function index()
    {
        $bicycles = Bicycle::all();
        return view('bicycles.index', compact('bicycles'));
    }

    public function create()
    {
        return view('bicycles.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'manufactor' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Bicycle::create($request->all());

        return redirect()->route('bicycles.index')->with('success', 'Bicycle created successfully.');
    }

    public function show(Bicycle $bicycle)
    {
        return view('bicycles.show', compact('bicycle'));
    }

    public function edit(Bicycle $bicycle)
    {
        return view('bicycles.edit', compact('bicycle'));
    }

    public function update(Request $request, Bicycle $bicycle)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'manufactor' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $bicycle->update($request->all());

        return redirect()->route('bicycles.index')->with('success', 'Bicycle updated successfully.');
    }

    public function destroy(Bicycle $bicycle)
    {
        $bicycle->delete();

        return redirect()->route('bicycles.index')->with('success', 'Bicycle deleted successfully.');
    }

    public function showCartTable()
    {
        $bicycles = Bicycle::all();

        return view('cart', compact('bicycles'));
    }

    public function addToCart($id)
    {
        $bicycle = Bicycle::find($id);

        if (!$bicycle) {
            abort(404);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $bicycle->title,
                "quantity" => 1,
                "price" => $bicycle->price,
                "photo" => $bicycle->image
            ];
        }

        session()->put('cart', $cart);

        if (request()->wantsJson()) {
            return response()->json(['message' => 'Bicycle added to cart successfully!']);
        }

        return redirect()->back()->with('success', 'Bicycle added to cart successfully!');
    }

    public function removeCartItem(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);

                session()->put('cart', $cart);
            }

            session()->flash('success', 'Bicycle removed successfully');
        }

        return redirect()->route('cart');
    }

    public function clearCart()
    {
        session()->forget('cart');
        return redirect()->back();
    }

    public function showProducts()
    {
        $bicycles = Bicycle::all();
        return view('welcome', compact('bicycles'));
    }

    public function cart()
    {
        return view('cart');
    }

    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity){
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            $cart = session()->get('cart');
            $total = 0;
            foreach($cart as $id => $details){
                $total += $details['price'] * $details['quantity'];
            }
            return response()->json(['total' => $total, 'subtotal' => $cart[$request->id]['price'] * $request->quantity]);
        }
    }
}
