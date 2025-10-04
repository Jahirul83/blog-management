<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['category', 'operator'])
            ->where('status', 1)
            ->latest()
            ->paginate(10);

        return view('frontend.index', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with(['category', 'operator'])
            ->where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        return view('frontend.show', compact('blog'));
    }
}
