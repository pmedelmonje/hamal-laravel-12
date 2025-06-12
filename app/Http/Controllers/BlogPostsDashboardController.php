<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogPostsDashboardController extends Controller
{
    public function index(Request $request)
    {
        $categories = BlogCategory::orderBy('index')->get();
        
        $posts = BlogPost::with('categories')
            ->when($request->category, function($query, $category) {
                return $query->whereHas('categories', function($q) use ($category) {
                    $q->where('slug', $category);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return view('dashboards.blog-posts.blog-posts-dashboard-index', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategory' => $request->category
        ]);
    }

    public function create()
    {
        $categories = BlogCategory::orderBy('index')->get();
        return view('dashboards.blog-posts.blog-posts-dashboard-create', 
        compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:blog_posts,title'],
            'content' => ['required', 'string'],
            // 'published' => ['sometimes', 'boolean'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:blog_categories,id'],
        ]);

        $post = BlogPost::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published' => $request->has('published'),
        ]);

        // Asociar categorías
        $post->categories()->sync($validated['categories']);

        return redirect()->route('blog-posts-dashboard.index')
            ->with('success', 'Post creado exitosamente');
    }

    public function show($slug)
    {
        $post = BlogPost::with('categories')->where('slug', $slug)->firstOrFail();
        $categories = BlogCategory::orderBy('index')->get();
        
        return view('dashboards.blog-posts.blog-posts-dashboard-show', [
            'post' => $post,
            'categories' => $categories,
            'nextPost' => $post->getNextPost(),
            'previousPost' => $post->getPreviousPost()
        ]);
    }

    // public function edit($slug)
    // {
    //     $post = BlogPost::with('categories')->where('slug', $slug)->firstOrFail();
    //     $categories = BlogCategory::orderBy('index')->get();
        
    //     return view('dashboards.blog.posts.edit', [
    //         'post' => $post,
    //         'categories' => $categories
    //     ]);
    // }

    public function update(Request $request, $slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255', 'unique:blog_posts,title,'.$post->id],
            'content' => ['required', 'string'],
            // 'published' => ['sometimes', 'boolean'],
            'categories' => ['required', 'array'],
            'categories.*' => ['exists:blog_categories,id'],
        ]);

        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published' => $request->has('published'),
        ]);

        // Actualizar categorías
        $post->categories()->sync($validated['categories']);

        return redirect()->route('blog-posts-dashboard.index')
            ->with('success', 'Post actualizado exitosamente');
    }

    public function destroy($slug)
    {
        $post = BlogPost::where('slug', $slug)->firstOrFail();

        // Eliminar relaciones con categorías
        $post->categories()->detach();

        $post->delete();

        return redirect()->route('blog-posts-dashboard.index')
            ->with('info', 'Post eliminado');
    }
}