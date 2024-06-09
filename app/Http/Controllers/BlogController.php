<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search') ?? '';
        $blogCategorySlug = $request->input('blog_category') ?? '';

        $blogs = Blog::where('is_published', true)
            ->orderBy('created_at', 'desc');

        if ($search) {
            $blogs->where('title', 'like', "%$search%");
        }

        if ($blogCategorySlug) {
            $blogs->whereHas('blogCategory', function ($query) use ($blogCategorySlug) {
                $query->where('slug', $blogCategorySlug);
            });
        }
        

        $blogs = $blogs->paginate(6);

        return view('blog.index', compact('blogs', 'search', 'blogCategorySlug'));
    }

    public function detail($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        $relatedBlogs = Blog::where('is_published', true)
            ->where('blog_category_id', $blog->blog_category_id)
            ->where('id', '!=', $blog->id)
            ->limit(3)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('blog.detail', compact('blog', 'relatedBlogs'));
    }

    // public function search(Request $request) {
    //     $query = $request->input('query');
    //     $blogs = Blog::where('is_published', true)
    //                  ->where('title', 'LIKE', "%{$query}%")
    //                  ->orWhere('content', 'LIKE', "%{$query}%")
    //                  ->get();
    //     return view('blog.index', compact('blogs'));
    // }
}
