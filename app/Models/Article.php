<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'excerpt',
        'excerpt_image',
        'content',
        'featured_image',
        'featured_image_description',
        'sort_order',
        'meta_title',
        'meta_description',
        'status',
        'is_featured',
        'is_breaking',
        'is_hero',
        'published_at',
        'views',
        'section_id',
        'pdf_file',
        'auther',
        'auther_description',
        'country',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_breaking' => 'boolean',
        'published_at' => 'datetime',
    ];

    /** Keep article-card queries small even when an article has huge LONGTEXT content. */
    public function scopeForCard(Builder $query): Builder
    {
        return $query
            ->select([
                'id', 'category_id', 'section_id', 'user_id', 'title', 'slug',
                'excerpt', 'featured_image', 'featured_image_description',
                'sort_order', 'status', 'is_featured', 'is_breaking', 'is_hero',
                'pdf_file', 'auther', 'published_at', 'views', 'created_at',
            ])
            // Some existing cards use content when excerpt is empty.
            ->selectRaw('LEFT(content, 1000) as content');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

     public function section()
    {
        return $this->belongsTo(Category::class, 'section_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function images()
    {
        return $this->hasMany(ArticleImage::class,'article_id');
    }
}
