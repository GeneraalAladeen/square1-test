<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->state([
            'username' => 'admin',
            'email' => 'admin@admin.com'
        ])->create();

        User::factory()->count(10)->hasPosts(100)->create();
    }
}
