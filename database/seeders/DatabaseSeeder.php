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
        \App\Models\Election::factory(4)->create();


        $posts = \App\Models\Post::all();
        $users = \App\Models\User::all();
        $tags = \App\Models\Tag::all();
        $elections = \App\Models\Election::all();

        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach(
                $tags->random(rand(1, 3))->pluck('id')->toArray()
            );
        });

        $posts->each(function ($post) {
            $post->image()->save(\App\Models\Image::factory()->make(['imageable_id' => $post->id, 'imageable_type' => 'App\Models\Post']));
            $post->image()->update(['url' => 'public/img/uploaded_images/seedPostImg.png']);
        });

        $users->each(function ($user) {
            $user->image()->save(\App\Models\Image::factory()->make(['imageable_id' => $user->id, 'imageable_type' => 'App\Models\User']));
        });

        $elections->each(function ($election) {
            $candidates = \App\Models\Candidate::factory(4)->make(['election_id' => $election->id]);
            // $candidates->each(function ($candidate) {
            //     $votes = \App\Models\Vote::factory(rand(0,5))->make(['candidate_id' => $candidate->id]);
            //     $candidate->votes()->saveMany($votes);
            // });
            $election->candidates()->saveMany($candidates);
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
