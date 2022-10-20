<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\{ Post, User };

class PostTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_authenticated_users_can_create_posts(): void
    {
        $this->actingAs(User::factory()->create());

        $title =  $this->faker->sentence();

        $response = $this->post('/posts', [
            'title' =>  $title,
            'description' => $this->faker->words(500, true),
            'publication_date' => now()
        ]);

        $response->assertRedirect('/posts')
            ->assertSessionHasNoErrors()
            ->assertSessionHas('status');

        $this->assertDatabaseHas('posts', [
            'title' =>  $title,
        ]);
    }

    public function test_guest_cannot_create_post(): void
    {
        $this->get('/posts/create')->assertRedirect('/login');
    }

    public function test_all_posts_params_are_required()
    {
        $this->actingAs(User::factory()->create());

        $this->post('/posts', )->assertSessionHasErrors(['title' , 'description' ,'publication_date']);
    }

    public function test_post_data_can_be_rendered(): void
    {
        $user = User::factory()->create();
        $post = Post::factory()->state(['user_id' => $user->id])->create();

        $response = $this->get('/'.$post->slug);

        $response->assertStatus(200)
            ->assertViewIs('posts.show')
            ->assertViewHas('post', function (Post $renderedPost) use ($post) {
                return $post->title === $renderedPost->title;
            });
    }
}
