<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
        // Section 1: Hero News (7 articles)
        $heroArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(7)
            ->get();

        $heroCenter = $heroArticles->slice(0, 1)->first();
        $heroLeft = $heroArticles->slice(1, 3);
        $heroRight = $heroArticles->slice(4, 3);

        // Section 3: Breaking / Trending News
        $breakingArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_breaking', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(5)
            ->get();

        $breakingTop = $breakingArticles->slice(0, 3);
        $breakingBottom = $breakingArticles->slice(3, 2)->values();

        // Section 4: Featured / Trending Stories
        $featuredArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(6)
            ->get();

        // Sidebar categories
        $categories = Category::where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Sidebar popular news
        $popularArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('views')
            ->take(3)
            ->get();

        // Section 5: One category section
        $selectedCategory = Category::where('name', 'Employment')->where('status', 1)
            ->whereHas('articles', function ($q) {
                $q->where('status', 'published');
            })
            ->first();

        $categoryArticles = collect();

        if ($selectedCategory) {
            $categoryArticles = Article::with(['category', 'author'])
                ->where('category_id', $selectedCategory->id)
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->take(9)
                ->get()
                ->values();
        }

        return view('home', compact(
            'heroCenter',
            'heroLeft',
            'heroRight',
            'breakingTop',
            'breakingBottom',
            'featuredArticles',
            'categories',
            'popularArticles',
            'selectedCategory',
            'categoryArticles'
        ));
    }

    public function show($slug)
    {
        $article = Article::with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $article->increment('views');

        $relatedArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        return view('news-details', compact('article', 'relatedArticles'));
    }
}