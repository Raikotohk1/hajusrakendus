<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    
    {
        $chirps = Chirp::with('user')->get();
        return view('chirps.index', compact('chirps'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('chirps.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(['message' => 'required']);
        $chirp = new Chirp();
        $chirp->message = $request->message;
        $chirp->user_id = auth()->id();
        $chirp->save();

        return redirect()->route('chirps.index');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Chirp $chirp)
    {
        return view('chirps.show', compact('chirp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        $chirp->update($request->all());

        return redirect()->route('chirps.index')->with('success', 'Chirp updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        $chirp->delete();

        return redirect()->route('chirps.index');
    }
}
