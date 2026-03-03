<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $NUMBER = 30;
        $CATEGORIES = ['laptops', 'smartphones', 'mens-watches', 'tablets', 'mobile-accessories'];
        
        for ($i = 0; $i < $NUMBER; $i++) {
            $categoryKey = array_rand($CATEGORIES);
            $category = $CATEGORIES[$categoryKey];
            
            $response = Http::withoutVerifying()->get("https://dummyjson.com/products/category/$category");
            $data = $response->json();
        
            // Vérifier que 'products' existe et n'est pas vide
            if (empty($data['products'])) {
                $this->command->warn("Aucun produit pour: $category");
                continue;
            }
            
            $randomKey = array_rand($data['products']);
            $item = $data['products'][$randomKey];
            
            $userId = \App\Models\User::inRandomOrder()->value('id') ?? 1;
            
            Article::create([
                "name" => $item["title"],
                'content' => $item['description'],
                'category' => $category,
                'price' => $item['price'],
                'image_path' => $item['thumbnail'],
                'user_id' => $userId
            ]);
        }
    }
}