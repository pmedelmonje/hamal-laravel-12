<?php

namespace App\Http\Controllers;

use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoriesDashboardController extends Controller
{
    public function index(Request $request)
    {
        $blogCategories = BlogCategory::orderBy('index')
        ->orderBy('name')
        ->paginate(20);

        return view('dashboards.blog-categories.blog-categories-index', compact('blogCategories'));
    }

    public function create(Request $request)
    {
        return view('dashboards.blog-categories.blog-categories-create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:blog_categories,name,blog_categories:id'],
            'index' => ['integer', 'required']
        ]);

        $newBlogCategory = BlogCategory::create($validated);
        
        return redirect()->route('blog-categories-dashboard.index')
        ->with('success', 'Categoría de posts creada exitosamente.');
    }

    public function show(Request $request, $slug)
    {
        $blogCategory = BlogCategory::where('slug', $slug)->firstOrFail();

        return view('dashboards.blog-categories.blog-categories-show',
        compact('blogCategory'));
    }

    public function update(Request $request, $slug)
    {
        $blogCategory = BlogCategory::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => ['string', 'required', 'min:3', 'unique:blog_categories,name,'.$blogCategory->id],
            'index' => ['integer', 'required']
        ]);

        if($request->filled('name'))
        {
            $blogCategory->name = $validated['name'];
        }

        if($request->filled('index'))
        {
            $blogCategory->index = $validated['index'];
        }

        $blogCategory->save();

        return redirect()->route('blog-categories-dashboard.index')
        ->with('success', 'Categoría de Posts actualizada');
    }

    public function destroy(Request $request, $slug)
    {
        $blogCategory = BlogCategory::where('slug', $slug)->firstOrFail();

        $blogCategory->delete();

        return redirect()->route('blog-categories-dashboard.index')
        ->with('info', 'Categoría eliminada');
    }
}
