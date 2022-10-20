<?php

namespace Tests\Feature;

use App\Models\{ Post, User };
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Contracts\Pagination\Paginator;
use Tests\TestCase;

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


    public function test_guest_can_view_posts_on_homepage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewHas('posts', fn ($posts) => $posts instanceof Paginator)
            ->assertViewHasAll(['posts', 'sort_fields']);
    }

    public function test_posts_can_be_sorted_by_publication_date(): void
    {
        User::factory()->hasPosts(20)->create();

        $sortDirection = $this->faker->randomElement(['asc', 'desc']);

        $response = $this->get("/?sort_by=publication_date&direction=$sortDirection");

        $response->assertViewHas('posts', fn (Paginator $posts) => $posts->isNotEmpty());
    }
}
