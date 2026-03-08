<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {

        $items = [

            /* ---------------- FOOD ---------------- */

            ['name'=>'Adobo','category'=>'food','price'=>150],
            ['name'=>'Sinigang','category'=>'food','price'=>150],
            ['name'=>'Kare-Kare','category'=>'food','price'=>180],
            ['name'=>'Lechon','category'=>'food','price'=>300],
            ['name'=>'Pancit Canton','category'=>'food','price'=>120],
            ['name'=>'Pancit Bihon','category'=>'food','price'=>120],
            ['name'=>'Pancit Malabon','category'=>'food','price'=>130],
            ['name'=>'Bulalo','category'=>'food','price'=>200],
            ['name'=>'Tinola','category'=>'food','price'=>150],
            ['name'=>'Afritada','category'=>'food','price'=>150],
            ['name'=>'Menudo','category'=>'food','price'=>150],
            ['name'=>'Mechado','category'=>'food','price'=>170],
            ['name'=>'Kaldereta','category'=>'food','price'=>170],
            ['name'=>'Bistek Tagalog','category'=>'food','price'=>170],
            ['name'=>'Sisig','category'=>'food','price'=>160],
            ['name'=>'Laing','category'=>'food','price'=>120],
            ['name'=>'Bicol Express','category'=>'food','price'=>160],
            ['name'=>'Pinakbet','category'=>'food','price'=>120],
            ['name'=>'Dinuguan','category'=>'food','price'=>140],
            ['name'=>'Tokwa’t Baboy','category'=>'food','price'=>130],
            ['name'=>'Lumpiang Shanghai','category'=>'food','price'=>120],
            ['name'=>'Lumpiang Gulay','category'=>'food','price'=>100],
            ['name'=>'Lumpiang Sariwa','category'=>'food','price'=>120],
            ['name'=>'Chicken Inasal','category'=>'food','price'=>170],
            ['name'=>'Batchoy','category'=>'food','price'=>140],
            ['name'=>'Arroz Caldo','category'=>'food','price'=>120],
            ['name'=>'Lugaw','category'=>'food','price'=>90],
            ['name'=>'Goto','category'=>'food','price'=>100],
            ['name'=>'Tapsilog','category'=>'food','price'=>120],
            ['name'=>'Longsilog','category'=>'food','price'=>120],
            ['name'=>'Bangsilog','category'=>'food','price'=>120],
            ['name'=>'Hotsilog','category'=>'food','price'=>110],
            ['name'=>'Tocilog','category'=>'food','price'=>120],
            ['name'=>'Spamsilog','category'=>'food','price'=>130],
            ['name'=>'Daingsilog','category'=>'food','price'=>130],

            ['name'=>'Chicken BBQ','category'=>'food','price'=>120],
            ['name'=>'Pork BBQ','category'=>'food','price'=>120],
            ['name'=>'Isaw','category'=>'food','price'=>60],
            ['name'=>'Betamax','category'=>'food','price'=>60],
            ['name'=>'Adidas','category'=>'food','price'=>60],

            ['name'=>'Crispy Pata','category'=>'food','price'=>300],
            ['name'=>'Crispy Pork Belly','category'=>'food','price'=>280],
            ['name'=>'Fried Chicken Filipino Style','category'=>'food','price'=>150],
            ['name'=>'Fried Tilapia','category'=>'food','price'=>140],
            ['name'=>'Fried Bangus','category'=>'food','price'=>150],

            ['name'=>'Chop Suey Filipino Style','category'=>'food','price'=>120],
            ['name'=>'Ampalaya with Egg','category'=>'food','price'=>110],
            ['name'=>'Ginisang Monggo','category'=>'food','price'=>110],

            /* ---------------- DESSERTS ---------------- */

            ['name'=>'Halo-Halo','category'=>'dessert','price'=>120],
            ['name'=>'Mais Con Yelo','category'=>'dessert','price'=>100],
            ['name'=>'Taho','category'=>'dessert','price'=>50],
            ['name'=>'Leche Flan','category'=>'dessert','price'=>90],
            ['name'=>'Ube Halaya','category'=>'dessert','price'=>120],
            ['name'=>'Polvoron','category'=>'dessert','price'=>60],
            ['name'=>'Pastillas de Leche','category'=>'dessert','price'=>70],
            ['name'=>'Yema','category'=>'dessert','price'=>70],
            ['name'=>'Brazo de Mercedes','category'=>'dessert','price'=>140],
            ['name'=>'Ensaymada','category'=>'dessert','price'=>80],
            ['name'=>'Pandesal','category'=>'dessert','price'=>50],
            ['name'=>'Pan de Coco','category'=>'dessert','price'=>70],
            ['name'=>'Spanish Bread','category'=>'dessert','price'=>70],
            ['name'=>'Buko Pie','category'=>'dessert','price'=>150],
            ['name'=>'Cassava Cake','category'=>'dessert','price'=>120],
            ['name'=>'Maja Blanca','category'=>'dessert','price'=>110],
            ['name'=>'Buko Pandan','category'=>'dessert','price'=>120],
            ['name'=>'Fruit Salad','category'=>'dessert','price'=>120],
            ['name'=>'Mango Float','category'=>'dessert','price'=>140],
            ['name'=>'Pichi-Pichi','category'=>'dessert','price'=>90],
            ['name'=>'Turon','category'=>'dessert','price'=>60],
            ['name'=>'Banana Cue','category'=>'dessert','price'=>60],
            ['name'=>'Kamote Cue','category'=>'dessert','price'=>60],
            ['name'=>'Maruya','category'=>'dessert','price'=>60],

            /* ---------------- DRINKS ---------------- */

            ['name'=>'Kalamansi Juice','category'=>'drink','price'=>60],
            ['name'=>'Buko Juice','category'=>'drink','price'=>70],
            ['name'=>'Sago’t Gulaman','category'=>'drink','price'=>60],
            ['name'=>'Pineapple Juice','category'=>'drink','price'=>70],
            ['name'=>'Mango Shake','category'=>'drink','price'=>80],
            ['name'=>'Avocado Shake','category'=>'drink','price'=>90],
            ['name'=>'Melon Juice','category'=>'drink','price'=>70],
            ['name'=>'Cucumber Juice','category'=>'drink','price'=>70],
            ['name'=>'Pandan Juice','category'=>'drink','price'=>70],
            ['name'=>'Ginger Tea','category'=>'drink','price'=>50],
            ['name'=>'Salabat','category'=>'drink','price'=>50],
            ['name'=>'Kapeng Barako','category'=>'drink','price'=>60],
            ['name'=>'Barako Coffee','category'=>'drink','price'=>60],
            ['name'=>'Iced Barako Coffee','category'=>'drink','price'=>70],
            ['name'=>'Tsokolate Eh','category'=>'drink','price'=>70],
            ['name'=>'Tsokolate Ah','category'=>'drink','price'=>70],
            ['name'=>'Sikwate','category'=>'drink','price'=>70],

        ];

        foreach ($items as $item) {
            Item::create($item);
        }

    }
}