<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    public function definition(): array
    {
        static $articleIds = null;
        $articleIds ??= Article::query()->pluck('id')->all();

        return [
            'user_id' => User::query()->inRandomOrder()->value('id') ?? User::factory(),
            'article_id' => !empty($articleIds)
                ? $this->faker->randomElement($articleIds)
                : Article::factory(),
        ];
    }
}