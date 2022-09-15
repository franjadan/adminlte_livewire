<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Image;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $path = 'https://picsum.photos/640/480.jpg';
        $filename = uniqid() . '.jpg';
        Image::make($path)->save(public_path('storage/posts/' . $filename));

        $users = \App\Models\User::where('role', 2)->pluck('id')->toArray();

        return [
            'user_id' => $this->faker->randomElement($users),
            'image' => 'posts/' . $filename,
            'title' => $this->faker->sentence(),
            'content' => $this->faker->text(),
        ];
    }
}
