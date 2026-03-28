<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\SubscriptionPlan;

class HomeController extends Controller
{
    public function index()
    {
        // Section 1: Hero News

        // Center Hero Article (latest published article)
        $heroCenter = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->first();

        // Left Side: Most Viewed Articles
        $heroLeft = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->when($heroCenter, function ($query) use ($heroCenter) {
                $query->where('id', '!=', $heroCenter->id);
            })
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();
        // dd($heroLeft);
        // Right Side: Recent Articles
        $heroRight = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->when($heroCenter, function ($query) use ($heroCenter) {
                $query->where('id', '!=', $heroCenter->id);
            })
            ->when($heroLeft->count(), function ($query) use ($heroLeft) {
                $query->whereNotIn('id', $heroLeft->pluck('id'));
            })
            ->latest('published_at')
            ->take(3)
            ->get();

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
        $selectedCategory = Category::where('name', 'Business')->where('status', 1)
            ->whereHas('articles', function ($q) {
                $q->where('status', 'published');
            })
            ->first();

        $categoryArticles = collect();

        if ($selectedCategory) {
            $categoryArticles = Article::with(['category', 'author'])
                ->where('category_id', $selectedCategory->id)
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->orderByDesc('published_at')
                ->take(9)
                ->get()
                ->values();
        }

        $ctaPlan = SubscriptionPlan::where('id', 1)
            ->where('status', 1)
            ->first();

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
            'categoryArticles',
            'ctaPlan'
        ));
    }

    public function newsIndex()
    {
        $articles = Article::with(['category', 'author', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(12)->withQueryString();

        $popularArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('views')
            ->take(3)
            ->get();

        $categories = Category::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $sidebarTags = Tag::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->take(14)
            ->get();

        $pageTitle = 'News';
        $pageType = 'news';
        $pageObject = null;

        return view('news.index', compact(
            'articles',
            'popularArticles',
            'categories',
            'sidebarTags',
            'pageTitle',
            'pageType',
            'pageObject'
        ));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)
            ->where('status', 1)
            ->firstOrFail();

        $articles = Article::with(['category', 'author', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('category_id', $category->id)
            ->latest('published_at')
            ->paginate(12)->withQueryString();

        $popularArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('views')
            ->take(3)
            ->get();

        $categories = Category::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $sidebarTags = Tag::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->take(14)
            ->get();

        $pageTitle = $category->name;
        $pageType = 'category';
        $pageObject = $category;

        return view('news.index', compact(
            'articles',
            'popularArticles',
            'categories',
            'sidebarTags',
            'pageTitle',
            'pageType',
            'pageObject'
        ));
    }

    public function tag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $articles = Article::with(['category', 'author', 'tags'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->whereHas('tags', function ($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            })
            ->latest('published_at')
            ->paginate(12)->withQueryString();

        $popularArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->orderByDesc('views')
            ->take(3)
            ->get();

        $categories = Category::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $sidebarTags = Tag::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->take(14)
            ->get();

        $pageTitle = $tag->name;
        $pageType = 'tag';
        $pageObject = $tag;

        return view('news.index', compact(
            'articles',
            'popularArticles',
            'categories',
            'sidebarTags',
            'pageTitle',
            'pageType',
            'pageObject'
        ));
    }
    public function newsDetailSlug($slug)
    {
        $article = Article::with(['category', 'author', 'tags'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->firstOrFail();

        $article->increment('views');

        $relatedArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(4)
            ->get();

        $popularArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('id', '!=', $article->id)
            ->orderByDesc('views')
            ->take(4)
            ->get();

        $categories = Category::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->where('status', 1)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        $sidebarTags = \App\Models\Tag::withCount([
            'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
        ])
            ->having('articles_count', '>', 0)
            ->orderByDesc('articles_count')
            ->take(14)
            ->get();

        return view('news.news-detail', compact(
            'article',
            'relatedArticles',
            'popularArticles',
            'categories',
            'sidebarTags'
        ));
    }
}