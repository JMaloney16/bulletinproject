<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)
        ->has(\App\Models\Post::factory()->count(3))
        ->create();
        \App\Models\Comment::factory(50)->create();
        \App\Models\Tag::factory(20)->create();

        $tags = \App\Models\Tag::all();

        \App\Models\Post::all()->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1,3))->pluck('id')->toArray()
            );
        });
        /*
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'),
            'is_admin' => '1',
            'remember_token' => Str::random(10),
        ]);
        */
    }
}
