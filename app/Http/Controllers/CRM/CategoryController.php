<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $query = Category::query();

        if (request('name')) {
            $query->where('name', 'like', '%' . request('name') . '%');
        }

        if (request('status') !== null && request('status') !== '') {
            $query->where('status', request('status'));
        }

        $categories = $query->latest()->paginate(10);

        return view('crm.category.index', compact('categories'));
    }

    public function create()
    {
        return view('crm.category.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        // Handle image upload
        $imagePath = null;
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('category-images', $filename, 'public');
            $imagePath = 'storage/category-images/' . $filename;
            $data['images'] = $imagePath;
        }

        Category::create($data);

        return redirect()->route('category.index')
            ->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('crm.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validated();
        $data['slug'] = Str::slug($data['slug'] ?: $data['name']);

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('category-images', $filename, 'public');
            $data['images'] = 'storage/category-images/' . $filename;
        }

        $category->update($data);

        return redirect()->route('category.index')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->articles()->count() > 0) {
            return redirect()->route('category.index')
                ->with('error', 'Cannot delete category because articles exist under it.');
        }

        $category->delete();

        return redirect()->route('category.index')
            ->with('success', 'Category deleted successfully.');
    }
}