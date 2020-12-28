<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(50),
            'content' => $this->faker->text(500),
            'user_id' => \App\Models\User::inRandomOrder()->first()->id,
            'imagepath' => 'public/img/uploaded_images/50TTmFqMGztrBn5C46QCg6COijVnS0SbQQLT2a0v.jpg'
        ];
    }
}
