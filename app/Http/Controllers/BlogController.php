<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;


class BlogController extends Controller
{
    public function index(Request $request)
    {
        $posts = BlogPost::with('categories')
        ->where('published', true)
        ->latest()
        ->paginate(10);

        $recentPosts = BlogPost::with('categories')
        ->latest()
        ->take(3)
        ->get(['title', 'slug', 'created_at']);

        $categories = BlogCategory::withCount(['posts' => function($query){
            $query->where('published', true);
        }])
        ->orderBy('index')
        ->get();

        return view('blog.blog-index', [
            'title' => 'Blog',
            'hero_title' => 'Blog',
            'hero_subtitle' => 'Artículos, tutoriales y reflexiones sobre desarrollo web, programación y tecnología.',
            'categories' => $categories,
            'posts' => $posts,
            'recentPosts' => $recentPosts,
        ]);
    }

    public function show(Request $request, $slug)
    {
        $post = BlogPost::where('slug', $slug)->first();

        $post->increment('visits_count');

        $categories = BlogCategory::withCount(['posts' => function($query) {
                        $query->where('published', true);
                    }])
        ->orderBy('index')
        ->get();

        $relatedPosts = BlogPost::whereHas('categories', function($query) use ($post) {
                            return $query->whereIn('blog_categories.id', 
                                $post->categories->pluck('id'));
                        })
        ->where('id', '!=', $post->id)
        ->where('published', true)
        ->latest()
        ->take(3)
        ->get(['title', 'slug', 'created_at']);

        return view('blog.blog-show', [
            'post' => $post, 
            'categories' =>$categories, 
            'relatedPosts' => $relatedPosts,
            'hero_title' => 'asdf',
            'hero_subtitle' => ''
        ]);
    }

    public function category(Request $request, $slug)
    {
        // Obtener posts de la categoría

        $category = BlogCategory::where('slug', $slug)->first();

        $posts = $category->posts()
                    ->where('published', true)
                    ->with(['categories'])
                    ->latest()
                    ->paginate(6);

        // Obtener categorías para el sidebar
        $categories = BlogCategory::withCount(['posts' => function($query) {
                        $query->where('published', true);
                    }])
                    ->orderBy('index')
                    ->get();

        // Obtener posts recientes
        $recentPosts = BlogPost::where('published', true)
                         ->latest()
                         ->take(3)
                         ->get(['title', 'slug', 'created_at']);

        return view('blog.blog-index', [
            'posts' => $posts, 
            'categories' => $categories, 
            'recentPosts' => $recentPosts, 
            'category' => $category,
            'hero_title' => $category->name,
            'hero_subtitle' => ''
        ]);
    }
}
