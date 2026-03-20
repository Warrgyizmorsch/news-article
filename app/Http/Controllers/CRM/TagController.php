<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        $query = Tag::query();

        if (request('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        $tags = $query->latest()->paginate(10);

        return view('crm.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('crm.tag.create');
    }

    public function store(StoreTagRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        Tag::create($data);

        return redirect()->route('tags.index')
            ->with('success', 'Tag created successfully.');
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('crm.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        $tag->update($data);

        return redirect()->route('tags.index')
            ->with('success', 'Tag updated successfully.');
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect()->route('tags.index')
            ->with('success', 'Tag deleted successfully.');
    }
}