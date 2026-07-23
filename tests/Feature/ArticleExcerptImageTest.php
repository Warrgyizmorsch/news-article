<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ArticleExcerptImageTest extends TestCase
{
    use RefreshDatabase;
    public function test_it_stores_an_excerpt_image_for_articles(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $response = $this->actingAs($user)->withoutMiddleware()->post(route('articles.store'), [
            'title' => 'Sample article',
            'slug' => 'sample-article',
            'excerpt' => 'Short excerpt',
            'content' => '<p>Body content</p>',
            'status' => 'published',
            'section_id' => 1,
            'excerpt_image' => UploadedFile::fake()->image('excerpt-image.jpg'),
        ]);

        $response->assertStatus(302);

        $article = Article::latest()->first();

        $this->assertNotNull($article);
        $this->assertNotNull($article->excerpt_image);
        Storage::disk('public')->assertExists($article->excerpt_image);
    }
}
