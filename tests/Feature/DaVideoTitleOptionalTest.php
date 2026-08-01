<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DaVideoTitleOptionalTest extends TestCase
{
    use RefreshDatabase;

    public function test_video_title_can_be_left_blank_when_creating_a_video(): void
    {
        $response = $this->post(route('videos.store'), [
            'title' => '',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);

        $response->assertRedirect(route('videos.index'));
        $response->assertSessionHas('success', 'Video added successfully!');

        $this->assertDatabaseHas('da_vedios', [
            'title' => '',
            'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
        ]);
    }
}
