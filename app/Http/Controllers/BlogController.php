<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search') ?? '';

        if ($search) {
            $blogs = Blog::where('title', 'like', "%$search%")
                ->where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->paginate(6);
            return view('blog.index', compact('blogs', 'search'));
        } else {
            $blogs = Blog::where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->paginate(6);
            return view('blog.index', compact('blogs', 'search'));
        }
    }

    public function detail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->where('is_published', true)
            ->take(2)
            ->get();
        return view('blog.detail', compact('blog', 'relatedBlogs'));
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $blogs = Blog::where('is_published', true)
                     ->where('title', 'LIKE', "%{$query}%")
                     ->orWhere('content', 'LIKE', "%{$query}%")
                     ->get();
        return view('blog.index', compact('blogs'));
    }
}
