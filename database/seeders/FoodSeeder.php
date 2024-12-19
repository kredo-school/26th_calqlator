<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $food = new Food;

        $foods = [
          //vegitable
          [ 'item_name' => 'tomato','calories' => 20,'amount' => '100g','protein' => 0.7,'fat' => 0.1,'carbs' => 4.7,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'carrot','calories' => 30,'amount' => '100g','protein' => 0.8,'fat' => 0.1,'carbs' => 8.7,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'eggplant','calories' => 18,'amount' => '100g','protein' => 1.1,'fat' => 0.1,'carbs' => 5.1,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'onion','calories' => 33,'amount' => '100g','protein' => 1.0,'fat' => 0.1,'carbs' => 8.4,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'potato','calories' => 76,'amount' => '100g','protein' => 1.9,'fat' => 0.3,'carbs' => 18.1,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'cucumber','calories' => 13,'amount' => '100g','protein' => 1.0,'fat' => 0.1,'carbs' => 3.0,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'baked sweet potato','calories' => 151,'amount' => '100g','protein' => 1.4,'fat' => 0.2,'carbs' => 39,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'steamed sweet potato','calories' => 131,'amount' => '100g','protein' => 1.2,'fat' => 0.2,'carbs' => 31.9,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'boiled corn','calories' => 95,'amount' => '100g','protein' => 3.5,'fat' => 1.7,'carbs' => 18.6,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'bell pepper','calories' => 20,'amount' => '100g','protein' => 0.9,'fat' => 0.2,'carbs' => 5.1,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'lettuce','calories' => 11,'amount' => '100g','protein' => 0.6,'fat' => 0.1,'carbs' => 2.8,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'cabage','calories' => 21,'amount' => '100g','protein' => 1.3,'fat' => 0.2,'carbs' => 5.2,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'broccoli','calories' => 30,'amount' => '100g','protein' => 3.9,'fat' => 0.4,'carbs' => 5.2,'created_at' => now(),'updated_at' => now(),],  
          //fruit
          ['item_name' => 'avocado','calories' => 178,'amount' => '100g','protein' => 2.1,'fat' => 17.5,'carbs' => 7.9,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'strawberry','calories' => 31,'amount' => '100g','protein' => 0.9,'fat' => 0.1,'carbs' => 8.5,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'orange','calories' => 48,'amount' => '100g','protein' => 0.9,'fat' => 0.1,'carbs' => 11.8,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'kiwi','calories' => 51,'amount' => '100g','protein' => 1.0,'fat' => 0.2,'carbs' => 13.4,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'grape fruit','calories' => 40,'amount' => '100g','protein' => 0.9,'fat' => 0.1,'carbs' => 9.6,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'american cherry','calories' => 64,'amount' => '100g','protein' => 1.2,'fat' => 0.1,'carbs' => 17.1,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'cherry','calories' => 64,'amount' => '100g','protein' => 1.0,'fat' => 0.2,'carbs' => 15.2,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'banana','calories' => 93,'amount' => '100g','protein' => 1.1,'fat' => 0.2,'carbs' => 22.5,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'pineapple','calories' => 54,'amount' => '100g','protein' => 0.6,'fat' => 0.1,'carbs' => 13.7,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'grape','calories' => 69,'amount' => '100g','protein' => 0.6,'fat' => 0.2,'carbs' => 16.9,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'blueberry','calories' => 48,'amount' =>'100g','protein' => 0.5,'fat' => 0.1,'carbs' => 12.9,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'mango','calories' => 68,'amount' =>'100g','protein' => 0.6,'fat' => 0.1,'carbs' => 16.9,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'raspberry','calories' => 36,'amount' =>'100g','protein' => 1.1,'fat' => 0.1,'carbs' => 10.2,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'apple','calories' => 56,'amount' =>'100g','protein' => 0.2,'fat' => 0.3,'carbs' => 16.2,'created_at' => now(),'updated_at' => now(),],  
          ['item_name' => 'lemon','calories' => 24,'amount' =>'100g','protein' => 0.4,'fat' => 0.2,'carbs' => 8.6,'created_at' => now(),'updated_at' => now(),],  
          //meat
          ['item_name' => 'beef chuck eye roll','calories' => 295,'amount' =>'100g','protein' => 16.2,'fat' => 26.4,'carbs' => 0.2,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'beef sirloin','calories' => 313,'amount' =>'100g','protein' => 16.5,'fat' => 27.9,'carbs' => 0.4,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'beef tenderloin','calories' => 177,'amount' =>'100g','protein' => 20.8,'fat' => 11.2,'carbs' => 0.5,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'beef round','calories' => 196,'amount' =>'100g','protein' => 19.5,'fat' => 13.3,'carbs' => 0.4,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'pork loin','calories' => 248,'amount' =>'100g','protein' => 19.3,'fat' => 19.2,'carbs' => 0.2,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'pork belly','calories' => 366,'amount' =>'100g','protein' => 14.4,'fat' => 35.4,'carbs' => 0.1,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'pork ham','calories' => 171,'amount' =>'100g','protein' => 20.5,'fat' => 10.2,'carbs' => 0.2,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'pork tenderloin','calories' => 118,'amount' =>'100g','protein' => 22.2,'fat' => 3.7,'carbs' => 0.3,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'chicken wing','calories' => 189,'amount' =>'100g','protein' => 17.8,'fat' => 14.3,'carbs' => 0,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'chicken breast(no skin)','calories' => 105,'amount' =>'100g','protein' => 23.3,'fat' => 1.9,'carbs' => 0.1,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'chicken breast(with skin)','calories' => 190,'amount' =>'100g','protein' => 16.6,'fat' => 14.2,'carbs' => 0,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'chicken tender','calories' => 98,'amount' =>'100g','protein' => 23.9,'fat' => 0.8,'carbs' => 0.1,'created_at' => now(),'updated_at' => now(),],
          //food
          ['item_name' => 'white rice','calories' => 168,'amount' =>'100g','protein' => 2.5,'fat' => 0.3,'carbs' => 37.1,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'white rice','calories' => 252,'amount' =>'150g','protein' => 3.8,'fat' => 0.5,'carbs' => 55.7,'created_at' => now(),'updated_at' => now(),],
          //supplements
          ['item_name' => 'Super Multiple Vitamin & Minerals','calories' => 3.36,'amount' =>'1tablet','protein' => 0.1,'fat' => 0.1,'carbs' => 0.656,'created_at' => now(),'updated_at' => now(),],
          //snacks
          ['item_name' => 'chocolate chip cookies','calories' => 488,'amount' =>'100g','protein' => 6,'fat' => 28,'carbs' => 58,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'cheese cake','calories' => 318,'amount' =>'100g','protein' => 8.5,'fat' => 21.2,'carbs' => 23.3,'created_at' => now(),'updated_at' => now(),],
          ['item_name' => 'pringles (sourcream&onion)','calories' => 532,'amount' =>'100g','protein' => 5.7,'fat' => 30.9,'carbs' => 57.6,'created_at' => now(),'updated_at' => now(),],
        ];

        $food->insert($foods);
    }
}
