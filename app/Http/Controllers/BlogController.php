<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return Inertia::render('Blog', [
            'blogs' => Blog::with('user:id,name', 'comments.user')->latest()->get(),
        ]);
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
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $request->user()->blogs()->create($validated);
 
        return redirect(route('blog.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): RedirectResponse
    {
        Gate::authorize('update', $blog);
 
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);
 
        $blog->update($validated);
 
        return redirect(route('blog.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog): RedirectResponse
    {
        Gate::authorize('delete', $blog);
 
        $blog->delete();
 
        return redirect(route('blog.index'));
    }
}
