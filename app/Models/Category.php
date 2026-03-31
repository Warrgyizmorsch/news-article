<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'images',
        'status',
        'sort_order',
        'main_menu',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
