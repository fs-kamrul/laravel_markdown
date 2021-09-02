<?php

namespace kamrul\Press\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use kamrul\Press\Models\Post;
use kamrul\Press\Tests\TestCase;

class SavePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_post_can_be_created_with_the_factory(){

        $post = factory(Post::class)->create();
//        $post = Post::factory()->create();;
        $this->assertCount(1, Post::all());
    }
}
