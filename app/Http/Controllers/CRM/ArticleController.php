<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index()
    {
        $query = Article::with(['category', 'author']);

        if (request('title')) {
            $query->where('title', 'like', '%' . request('title') . '%');
        }

        if (request('status')) {
            $query->where('status', request('status'));
        }

        if (request('category_id')) {
            $query->where('category_id', request('category_id'));
        }

        $articles = $query->orderBy('id','desc')->latest()->paginate(10);
        $allCategories = Category::where('status', 1)->orderBy('name')->get();

        return view('crm.article.index', compact('articles', 'allCategories'));
    }

    public function create()
    {
        $categories = Category::where('status', 1)->orderBy('sort_order')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('crm.article.create', compact('categories', 'tags'));
    }

    public function store(StoreArticleRequest $request)
    {
        $data = $request->validated();

        $data['user_id'] = Auth::id();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_breaking'] = $request->boolean('is_breaking');
        $data['is_hero'] = $request->boolean('is_hero');

        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        $article = Article::create($data);

        if (!empty($data['tags'])) {
            $article->tags()->sync($data['tags']);
        }

        return redirect()->route('articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit($id)
    {
        $article = Article::with('tags')->findOrFail($id);
        $categories = Category::where('status', 1)->orderBy('sort_order')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        return view('crm.article.edit', compact('article', 'categories', 'tags'));
    }

    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['title']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_breaking'] = $request->boolean('is_breaking');
        $data['is_hero'] = $request->boolean('is_hero');

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
                Storage::disk('public')->delete($article->featured_image);
            }

            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        if ($data['status'] === 'published' && empty($article->published_at) && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($data['status'] !== 'published') {
            $data['published_at'] = $data['published_at'] ?? $article->published_at;
        }

        $article->update($data);
        $article->tags()->sync($data['tags'] ?? []);

        return redirect()->route('articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return redirect()->route('articles.index')
            ->with('success', 'Article moved to trash successfully.');
    }

    public function trashed()
    {
        $articles = Article::onlyTrashed()
            ->with(['category', 'author'])
            ->latest('deleted_at')
            ->paginate(10);

        return view('crm.article.trashed', compact('articles'));
    }

    public function restore($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();

        return redirect()->route('articles.trashed')
            ->with('success', 'Article restored successfully.');
    }

    public function forceDelete($id)
    {
        $article = Article::onlyTrashed()->findOrFail($id);

        if ($article->featured_image && Storage::disk('public')->exists($article->featured_image)) {
            Storage::disk('public')->delete($article->featured_image);
        }

        $article->tags()->detach();
        $article->forceDelete();

        return redirect()->route('articles.trashed')
            ->with('success', 'Article permanently deleted successfully.');
    }
}