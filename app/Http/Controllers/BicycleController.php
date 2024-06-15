<?php

namespace App\Http\Controllers;

use App\Models\Bicycle;
use Illuminate\Http\Request;

class BicycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bicycles = Bicycle::all();
        return view('bicycles.index', compact('bicycles'));
      
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
        
         return view('bicycles.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(Bicycle $bicycle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bicycle $bicycle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Bicycle $bicycle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bicycle $bicycle)
    {
        //
    }
}
