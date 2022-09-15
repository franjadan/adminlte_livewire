<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'francisco',
            'email' => 'francisco.adan@qastusoft.com',
            'password' => \bcrypt('qwerasdf'),
            'role' => 1
        ]);

        \App\Models\User::factory(10)->create();

        Storage::deleteDirectory('posts');
        Storage::makeDirectory('posts');

        \App\Models\Post::factory(20)->create();
    }
}
