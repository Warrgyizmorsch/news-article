<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories', 'slug')->ignore($id)],
            'description' => 'nullable|string',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status' => 'required|boolean',
            'sort_order' => 'nullable|integer',
        ];
    }
}