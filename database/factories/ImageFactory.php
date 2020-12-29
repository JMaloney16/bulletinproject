<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $imageable = [
            Post::class,
            User::class,
        ];
        $imageableType = $this->faker->randomElement($imageable);
        $imageable = $imageableType::factory()->make();

        return [
            'url' => 'public/img/uploaded_images/50TTmFqMGztrBn5C46QCg6COijVnS0SbQQLT2a0v.jpg',
            'imageable_id' => $imageable->id,
            'imageable_type' => $imageableType,
        ];
    }
}
