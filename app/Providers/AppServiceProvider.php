<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191);

        View::composer('*', function ($view) {
            // Footer Top Categories
            $footerCategories = Category::withCount([
                'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
            ])
                ->where('status', 1)
                ->where('main_menu', 1)
                // ->having('articles_count', '>', 0)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->take(8)
                ->get();

            // Footer Recent Posts

            $currentMonth = Carbon::now();

            $categories = Category::whereIn('slug', ['business', 'lifestyle', 'bookshelf'])
                ->where('status', 1)
                ->get()
                ->keyBy('slug');

            $footerRecentPosts = collect();

            foreach (['politics', 'business', 'lifestyle', 'bookshelf'] as $slug) {

                // 🔥 POLITICS (via section_id)
                if ($slug === 'politics') {

                    $article = Article::with(['author', 'category'])
                        ->where('section_id', 22) // ✅ same as newHome
                        ->where('status', 'published')
                        ->whereNotNull('published_at')

                        ->whereMonth('published_at', $currentMonth->month)
                        ->whereYear('published_at', $currentMonth->year)

                        ->orderByRaw('CASE WHEN sort_order = 0 THEN 1 ELSE 0 END')
                        ->orderBy('sort_order')
                        ->orderByDesc('published_at')

                        ->first();
                } else {

                    if (!isset($categories[$slug])) {
                        continue;
                    }

                    $article = Article::with(['author', 'category'])
                        ->where('category_id', $categories[$slug]->id)
                        ->where('status', 'published')
                        ->whereNotNull('published_at')

                        ->whereMonth('published_at', $currentMonth->month)
                        ->whereYear('published_at', $currentMonth->year)

                        ->orderByRaw('CASE WHEN sort_order = 0 THEN 1 ELSE 0 END')
                        ->orderBy('sort_order')
                        ->orderByDesc('published_at')

                        ->first();
                }

                // ✅ Push if exists
                if ($article) {
                    $footerRecentPosts->push($article);
                }
            }

            // $footerRecentPosts = Article::with(['author'])
            //     ->where('status', 'published')
            //     ->where('category_id', '!=', 21)
            //     ->whereNotNull('published_at')
            //     ->latest('published_at')
            //     ->take(3)
            //     ->get();

            // Footer Tags
            $footerTags = Tag::withCount([
                'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
            ])
                // ->having('articles_count', '>', 0)
                ->orderByDesc('articles_count')
                ->take(14)
                ->get();

            $headerCategories = Category::withCount([
                'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
            ])
                ->where('status', 1)
                ->where('main_menu', 1)
                // ->having('articles_count', '>', 0)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->take(8)
                ->get();

            $headerSubCategories = Category::withCount([
                'articles' => function ($q) {
                    $q->where('status', 'published')
                        ->whereNotNull('published_at');
                }
            ])
                ->where('status', 1)
                ->where('main_menu', 0)
                ->having('articles_count', '>', 0)
                ->orderBy('sort_order')
                ->orderBy('name')
                ->get();

            $headerBreakingNews = Article::select('id', 'title', 'slug')
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('is_breaking', true)
                ->latest('published_at')
                ->take(3)
                ->get();

            $headerTrendingTags = Tag::withCount([
                'articles' => function ($q) {
                $q->where('status', 'published')
                    ->whereNotNull('published_at');
            }
            ])
                ->having('articles_count', '>', 0)
                ->orderByDesc('articles_count')
                ->take(8)
                ->get();

            $headerMegaFeaturedNews = Article::with(['author', 'category'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where(function ($q) {
                $q->where('is_breaking', true)
                    ->orWhere('is_featured', true);
            }
            )
                ->latest('published_at')
                ->first();

            $headerMegaLatestNews = Article::with(['author', 'category'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->when($headerMegaFeaturedNews, function ($q) use ($headerMegaFeaturedNews) {
                $q->where('id', '!=', $headerMegaFeaturedNews->id);
            }
            )
                ->latest('published_at')
                ->take(2)
                ->get();

            $headerMegaBreakingNews = Article::with(['author', 'category'])
                ->where('status', 'published')
                ->whereNotNull('published_at')
                ->where('is_breaking', true)
                ->when($headerMegaFeaturedNews, function ($q) use ($headerMegaFeaturedNews) {
                $q->where('id', '!=', $headerMegaFeaturedNews->id);
            }
            )
                ->latest('published_at')
                ->take(2)
                ->get();

            $authUser = auth()->user();

            $headerHasActiveSubscription = false;

            if ($authUser && $authUser->role !== 'admin') {
                $headerHasActiveSubscription = true;

                // Future subscription logic
                // $headerHasActiveSubscription = $authUser->subscriptions()
                //     ->where('status', 'active')
                //     ->whereDate('end_date', '>=', now())
                //     ->exists();
            }

            $view->with([
                'footerCategories' => $footerCategories,
                'footerRecentPosts' => $footerRecentPosts,
                'footerTags' => $footerTags,

                'headerCategories' => $headerCategories,
                'headerSubCategories' => $headerSubCategories,
                'headerBreakingNews' => $headerBreakingNews,
                'headerTrendingTags' => $headerTrendingTags,

                'headerMegaFeaturedNews' => $headerMegaFeaturedNews,
                'headerMegaLatestNews' => $headerMegaLatestNews,
                'headerMegaBreakingNews' => $headerMegaBreakingNews,

                'headerHasActiveSubscription' => $headerHasActiveSubscription,
            ]);
        });
    }
}