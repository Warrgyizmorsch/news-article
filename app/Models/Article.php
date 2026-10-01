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

    public function scopeMatchingTerms(Builder $query, array $terms): Builder
    {
        foreach ($terms as $term) {
            $like = '%' . $term . '%';

            $query->where(function (Builder $matches) use ($like) {
                $matches->where('title', 'like', $like)
                    ->orWhere('slug', 'like', $like)
                    ->orWhere('excerpt', 'like', $like)
                    ->orWhere('content', 'like', $like)
                    ->orWhere('meta_title', 'like', $like)
                    ->orWhere('meta_description', 'like', $like)
                    ->orWhere('country', 'like', $like)
                    ->orWhere('auther', 'like', $like)
                    ->orWhere('auther_description', 'like', $like)
                    ->orWhereHas('category', function (Builder $category) use ($like) {
                        $category->where('name', 'like', $like);
                    })
                    ->orWhereHas('section', function (Builder $section) use ($like) {
                        $section->where('name', 'like', $like);
                    })
                    ->orWhereHas('tags', function (Builder $tag) use ($like) {
                        $tag->where('name', 'like', $like);
                    })
                    ->orWhereHas('author', function (Builder $author) use ($like) {
                        $author->where('name', 'like', $like);
                    });
            });
        }

        return $query;
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
