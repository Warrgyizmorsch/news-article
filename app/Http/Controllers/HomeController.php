<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use App\Models\SubscriptionPlan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Request;
use App\Models\DaVideo;

class HomeController extends Controller
{
    public function index()
    {
        // Section 1: Hero News

        // Center Hero Article (latest published article)
        $heroCenter = Article::with(['category','images', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('section_id', 21)
            ->latest('created_at')
            ->first();

        // Left Side: Most Viewed Articles
        $heroLeft = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('is_hero',1)
            ->when($heroCenter, function ($query) use ($heroCenter) {
                $query->where('id', '!=', $heroCenter->id);
            })
            ->orderByDesc('views')
            ->orderByDesc('published_at')
            ->take(3)
            ->get();
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

        // Section 3: Monthly Edition News
        $monthlyEditionCategory = Category::where('slug', 'monthly-editions')
            ->where('status', 1)
            ->whereHas('articles', function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            })
            ->first();

        $monthlyEditionArticles = collect();

        if ($monthlyEditionCategory) {
            $monthlyEditionArticles = Article::with(['category', 'author'])
                ->where('category_id', $monthlyEditionCategory->id)
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->take(3)
                ->get()
                ->values();
        }

        // $breakingArticles = Article::with(['category', 'author'])
        //     ->where('status', 'published')
        //     ->where('category_id', $monthlyEditionCategoryId)
        //     ->whereNotNull('published_at')
        //     ->latest('published_at')
        //     ->take(5)
        //     ->get();

        // $breakingTop = $breakingArticles->slice(0, 3);
        // $breakingBottom = $breakingArticles->slice(3, 2)->values();

        // Section 4: Featured / Trending Stories
        $featuredArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->where('category_id', '!=', 21)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(6)
            ->get();

        // Sidebar categories
        $categories = Category::where('status', 1)
            ->where('slug', '!=', 'politics') // exclude politics here
            ->whereHas('articles', function ($query) {
                $query->where('status', 'published'); // only categories having published articles
            })
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('status', 'published');
                }
            ])
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        // Sidebar popular news
        $popularArticles = Article::with(['category', 'author'])
            ->where('status', 'published')
            ->where('category_id', '!=', 21)
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

        // Section 6: Asia In Brief
        $asiaInBriefCategory = Category::where('slug', 'asia-in-brief')
            ->where('status', 1)
            ->whereHas('articles', function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            })
            ->first();

        $asiaInBriefArticles = collect();

        if ($asiaInBriefCategory) {
            $asiaInBriefArticles = Article::with(['category', 'author'])
                ->where('category_id', $asiaInBriefCategory->id)
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->latest('published_at')
                ->take(3)
                ->get()
                ->values();
        }

        // Politics Category
$politicsCategory = Category::where('slug', 'politics')
    ->where('status', 1)
    ->first();

$politicsArticles = collect();

if ($politicsCategory) {
    $politicsArticles = Article::with(['category', 'author'])
        ->where('section_id', 22)
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->latest('published_at')
        ->take(6) // same as featured count
        ->get()
        ->values();
}

        // Section: Bookshelf
$bookshelfCategory = Category::where('slug', 'bookshelf')
    ->where('status', 1)
    ->whereHas('articles', function ($q) {
        $q->where('status', 'published')
          ->whereNotNull('published_at');
    })
    ->first();

$bookshelfArticles = collect();

if ($bookshelfCategory) {
    $bookshelfArticles = Article::with(['category', 'author'])
        ->where('category_id', $bookshelfCategory->id)
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->latest('published_at')
        ->take(3)
        ->get()
        ->values();
}

// Section: Lifestyle
        $lifestyleCategory = Category::where('slug', 'lifestyle')->where('status', 1)
            ->whereHas('articles', function ($q) {
                $q->where('status', 'published');
            })
            ->first();

        $lifestyleArticles = collect();

        if ($lifestyleCategory) {
            $lifestyleArticles = Article::with(['category', 'author'])
                ->where('category_id', $lifestyleCategory->id)
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

        $featuredVideos = DaVideo::latest()->limit(10)->get();

        return view('home', compact(
            'heroCenter',
            'heroLeft',
            'heroRight',
            // 'breakingTop',
            // 'breakingBottom',
            'featuredArticles',
            'categories',
            'popularArticles',
            'selectedCategory',
            'categoryArticles',
            'ctaPlan',
            'asiaInBriefCategory',
            'asiaInBriefArticles',
            'bookshelfCategory',
            'bookshelfArticles',
            'lifestyleCategory',
            'lifestyleArticles',
            'politicsCategory',
            'politicsArticles',
            'monthlyEditionCategory',
            'monthlyEditionArticles',
            'featuredVideos'
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

        $categories = Category::where('status', 1)
            ->whereHas('articles', function ($query) {
                $query->where('status', 'published'); // only categories having published articles
            })
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('status', 'published');
                }
            ])
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

        if ($slug === 'monthly-editions') {
            $latestArticle = Article::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('category_id', $category->id)
                ->latest('published_at')
                ->first();

            $otherArticles = Article::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('category_id', $category->id)
                ->when($latestArticle, function ($query) use ($latestArticle) {
                    $query->where('id', '!=', $latestArticle->id);
                })
                ->latest('published_at')
                ->paginate(12)->withQueryString();

            $pageTitle = $category->name;
            $pageType = 'category';
            $pageObject = $category;

            return view('news.monthly-edition', compact(
                'latestArticle',
                'otherArticles',
                'pageTitle',
                'pageType',
                'pageObject'
            ));
        }

         if ($slug === 'asia-in-brief') {
            $latestArticle = Article::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('category_id', $category->id)
                ->latest('published_at')
                ->first();

            $otherArticles = Article::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('category_id', $category->id)
                ->when($latestArticle, function ($query) use ($latestArticle) {
                    $query->where('id', '!=', $latestArticle->id);
                })
                ->latest('published_at')
                ->paginate(12)->withQueryString();

            $pageTitle = $category->name;
            $pageType = 'category';
            $pageObject = $category;

            return view('news.asia-this-month', compact(
                'latestArticle',
                'otherArticles',
                'pageTitle',
                'pageType',
                'pageObject'
            ));
        }
         if ($slug === 'editorial') {
            $latestArticle = Article::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('category_id', $category->id)
                ->latest('published_at')
                ->first();

            $otherArticles = Article::with(['category', 'author', 'tags'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('category_id', $category->id)
                ->when($latestArticle, function ($query) use ($latestArticle) {
                    $query->where('id', '!=', $latestArticle->id);
                })
                ->latest('published_at')
                ->paginate(12)->withQueryString();

            $pageTitle = $category->name;
            $pageType = 'category';
            $pageObject = $category;

            return view('news.editorial', compact(
                'latestArticle',
                'otherArticles',
                'pageTitle',
                'pageType',
                'pageObject'
            ));
        }

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

        $categories = Category::where('status', 1)
            ->whereHas('articles', function ($query) {
                $query->where('status', 'published'); // only categories having published articles
            })
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('status', 'published');
                }
            ])
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

        $categories = Category::where('status', 1)
            ->whereHas('articles', function ($query) {
                $query->where('status', 'published'); // only categories having published articles
            })
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('status', 'published');
                }
            ])
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

        $categories = Category::where('status', 1)
            ->whereHas('articles', function ($query) {
                $query->where('status', 'published'); // only categories having published articles
            })
            ->withCount([
                'articles as articles_count' => function ($query) {
                    $query->where('status', 'published');
                }
            ])
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

        return view('news.news-detail', compact(
            'article',
            'relatedArticles',
            'popularArticles',
            'categories',
            'sidebarTags'
        ));
    }

public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $email = trim(strtolower($request->email));

        $user = User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => strtok($email, '@'),
                'email' => $email,
                'password' => Hash::make('user@123'),
                'role' => 'user',
            ]);
        }

        // \App\Models\UserSubscription::firstOrCreate([
        //     'email' => $email,
        // ]);

        Auth::login($user);

        return redirect()->back()->with('success', 'Subscribed successfully.');
    }
}
