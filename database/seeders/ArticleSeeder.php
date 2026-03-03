<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Support\Facades\Http;
use Illuminate\Database\Seeder;


class ArticleSeeder extends Seeder
{
  public function run():void
    {

        $response = Http::withoutVerifying()->get("https://dummyjson.com/products/category/laptops");
        $data = $response -> json();
        
        foreach ($data['products'] as $item) {
        Article::create([

            "name"=> $item["title"],
            'content'=> $item['description'],
            'price'=> $item['price'],
            'image_path'=> $item['thumbnail'],
            'user_id' =>1
            
            ]);
        }
    }
}
