<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleImage extends Model
{
    //
    protected $table = 'article_images';

    protected $fillable = [
        'article_id',
        'image',
    ];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/blank.jpeg');
        }

        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }

        $cleanPath = ltrim($this->image, '/');

        if (file_exists(public_path('storage/' . $cleanPath)) || file_exists(storage_path('app/public/' . $cleanPath))) {
            return asset('storage/' . $cleanPath);
        }

        if (app()->environment('local')) {
            return 'https://democracyasia.com/storage/' . $cleanPath;
        }

        return asset('storage/' . $cleanPath);
    }
}

