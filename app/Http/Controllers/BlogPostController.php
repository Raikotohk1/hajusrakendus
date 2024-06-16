<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BlogPostController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('BlogPost', [
            'blogs' => Blog::with('user:id,name', 'comments.user')->latest()->get(),
        ]);
    }
}
