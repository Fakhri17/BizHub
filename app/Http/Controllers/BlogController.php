<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index() {
        $blogs = Blog::where('is_published', true)->get();
        return view('blog.index', compact('blogs'));
    }

    public function show($slug) {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
                        ->where('id', '!=', $blog->id)
                        ->where('is_published', true)
                        ->take(2) // Ambil 3 blog terkait
                        ->get();
        return view('blog.detail', compact('blog', 'relatedBlogs'));
    }
}

