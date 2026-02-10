<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */


    public function makeProducts(): string
    {
        $categories = ['laptop', 'shoes'];
        return $this->faker->randomElement($categories);
    }
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid,
            'name' => fake()->name(),
            'content' => fake()->text(),
            'price' => fake()->randomFloat(2, 1, 1000),
            'user_id' => 1,
            'image_path' => "https://loremflickr.com/100/100/{$this->makeProducts()}"
        ];
    }
}