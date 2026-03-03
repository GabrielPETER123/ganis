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

    public function definition(): array
    {
        $categories = ['laptops', 'smartphones', 'mens-watches', 'motorcycles'];
        $category = $categories[array_rand($categories)];
        
        return [
            'name' => fake()->words(3, true),
            'content' => fake()->paragraph(),
            'category' => $category,
            'price' => fake()->numberBetween(100, 5000),
            'image_path' => fake()->imageUrl(),
            'user_id' => 1,
        ];
    }
}