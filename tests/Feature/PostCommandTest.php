<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\AdminSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class PostCommandTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;


    public function test_update_posts_command_saves_new_posts(): void
    {
        $this->seed(AdminSeeder::class);

        Http::fake(function () {
            return Http::response([
                'articles' => [
                    [
                        'title' => $this->faker->sentence(),
                        'description' => $this->faker->paragraph(5),
                    ],
                ],
            ]);
        });

        $this->artisan('post:fetch')->assertSuccessful();
    }

    public function test_data_wlll_rollback_when_error_occurs(): void
    {
        $this->seed(AdminSeeder::class);

        Http::fake(function () {
            return Http::response([
                'articles' => [
                    [
                        'title' => $this->faker->sentence(),
                        'description' => $this->faker->paragraph(5),
                    ],
                    [
                        'title' => $this->faker->paragraph(5),
                    ],
                ],
            ]);
        });

        $this->artisan('post:fetch') ->assertFailed()->assertExitCode(0);
    }
}
