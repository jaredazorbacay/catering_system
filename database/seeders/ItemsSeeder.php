<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use Illuminate\Support\Facades\DB;

class ItemsSeeder extends Seeder
{
    public function run(): void
    {

        $items = [

            /* FOOD */

            [
                'name'=>'Adobo',
                'category'=>'food',
                'price'=>150,
                'description'=>'Classic Filipino dish cooked in soy sauce, vinegar and garlic.',
                'photo_url'=>'/images/items/adobo.jpg',
                'serving'=>3
            ],

            [
                'name'=>'Sinigang',
                'category'=>'food',
                'price'=>150,
                'description'=>'Filipino sour tamarind soup with vegetables and meat.',
                'photo_url'=>'/images/items/sinigang.jpg',
                'serving'=>2
            ],

            [
                'name'=>'Kare-Kare',
                'category'=>'food',
                'price'=>500,
                'description'=>'Peanut stew with vegetables served with shrimp paste.',
                'photo_url'=>'/images/items/kare-kare.jpg',
                'serving'=>5
            ],

            [
                'name'=>'Lechon',
                'category'=>'food',
                'price'=>3000,
                'description'=>'Crispy roasted pig commonly served during celebrations.',
                'photo_url'=>'/images/items/lechon.jpg',
                'serving'=>30
            ],

            [
                'name'=>'Pancit Canton',
                'category'=>'food',
                'price'=>120,
                'description'=>'Stir-fried egg noodles with vegetables and meat.',
                'photo_url'=>'/images/items/pancit-canton.jpg',
                'serving'=>3
            ],

            [
                'name'=>'Pancit Bihon',
                'category'=>'food',
                'price'=>120,
                'description'=>'Rice noodle dish with vegetables and meat.',
                'photo_url'=>'/images/items/pancit-bihon.jpg',
                'serving'=>3
            ],

            [
                'name'=>'Bulalo',
                'category'=>'food',
                'price'=>500,
                'description'=>'Beef marrow soup simmered for hours with vegetables.',
                'photo_url'=>'/images/items/bulalo.jpg',
                'serving'=>4
            ],

            [
                'name'=>'Tinola',
                'category'=>'food',
                'price'=>350,
                'description'=>'Chicken soup with ginger, green papaya and chili leaves.',
                'photo_url'=>'/images/items/tinola.jpg',
                'serving'=>4
            ],

            [
                'name'=>'Afritada',
                'category'=>'food',
                'price'=>650,
                'description'=>'Tomato based chicken stew with vegetables.',
                'photo_url'=>'/images/items/afritada.jpg',
                'serving'=>8
            ],

            [
                'name'=>'Menudo',
                'category'=>'food',
                'price'=>650,
                'description'=>'Pork stew with liver, potatoes and tomato sauce.',
                'photo_url'=>'/images/items/menudo.jpg',
                'serving'=>8
            ],

            [
                'name'=>'Mechado',
                'category'=>'food',
                'price'=>700,
                'description'=>'Beef stew cooked slowly in tomato sauce.',
                'photo_url'=>'/images/items/mechado.jpg',
                'serving'=>8
            ],

            [
                'name'=>'Kaldereta',
                'category'=>'food',
                'price'=>560,
                'description'=>'Rich goat or beef stew with liver spread and vegetables.',
                'photo_url'=>'/images/items/kaldereta.jpg',
                'serving'=>6
            ],

            [
                'name'=>'Bistek Tagalog',
                'category'=>'food',
                'price'=>500,
                'description'=>'Beef steak marinated in soy sauce with onions.',
                'photo_url'=>'/images/items/bistek.jpg',
                'serving'=>4
            ],

            [
                'name'=>'Sisig',
                'category'=>'food',
                'price'=>270,
                'description'=>'Sizzling pork dish seasoned with calamansi and chili.',
                'photo_url'=>'/images/items/sisig.jpg',
                'serving'=>3
            ],

            [
                'name'=>'Pinakbet',
                'category'=>'food',
                'price'=>240,
                'description'=>'Mixed vegetable dish flavored with shrimp paste.',
                'photo_url'=>'/images/items/pinakbet.jpg',
                'serving'=>5
            ],

            [
                'name'=>'Dinuguan',
                'category'=>'food',
                'price'=>280,
                'description'=>'Savory pork stew cooked in pig blood and vinegar.',
                'photo_url'=>'/images/items/dinuguan.jpg',
                'serving'=>3
            ],

            [
                'name'=>'Chicken Inasal',
                'category'=>'food',
                'price'=>170,
                'description'=>'Grilled chicken marinated in citrus and annatto oil.',
                'photo_url'=>'/images/items/inasal.jpg',
                'serving'=>2
            ],

            [
                'name'=>'Crispy Pata',
                'category'=>'food',
                'price'=>300,
                'description'=>'Deep fried pork leg with crispy skin.',
                'photo_url'=>'/images/items/crispy-pata.jpg',
                'serving'=>3
            ],

            [
                'name'=>'Fried Chicken Filipino Style',
                'category'=>'food',
                'price'=>570,
                'description'=>'Golden fried chicken seasoned Filipino style.',
                'photo_url'=>'/images/items/fried-chicken.jpg',
                'serving'=>8
            ],

            [
                'name'=>'Fried Tilapia',
                'category'=>'food',
                'price'=>480,
                'description'=>'Whole tilapia fried until crispy.',
                'photo_url'=>'/images/items/fried-tilapia.jpg',
                'serving'=>5
            ],

            [
                'name'=>'Fried Bangus',
                'category'=>'food',
                'price'=>450,
                'description'=>'Milkfish fried to perfection.',
                'photo_url'=>'/images/items/fried-bangus.jpg',
                'serving'=>5
            ],


            /* DESSERTS */

            [
                'name'=>'Halo-Halo',
                'category'=>'dessert',
                'price'=>120,
                'description'=>'Shaved ice dessert with fruits, beans and milk.',
                'photo_url'=>'/images/items/halo-halo.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Mais Con Yelo',
                'category'=>'dessert',
                'price'=>100,
                'description'=>'Sweet corn dessert served with shaved ice and milk.',
                'photo_url'=>'/images/items/mais-con-yelo.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Taho',
                'category'=>'dessert',
                'price'=>50,
                'description'=>'Soft tofu dessert with syrup and tapioca pearls.',
                'photo_url'=>'/images/items/taho.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Leche Flan',
                'category'=>'dessert',
                'price'=>170,
                'description'=>'Creamy caramel custard dessert.',
                'photo_url'=>'/images/items/leche-flan.jpg',
                'serving'=>2

            ],

            [
                'name'=>'Ube Halaya',
                'category'=>'dessert',
                'price'=>120,
                'description'=>'Sweet purple yam jam dessert.',
                'photo_url'=>'/images/items/ube-halaya.jpg',
                'serving'=>2
            ],

            [
                'name'=>'Mango Float',
                'category'=>'dessert',
                'price'=>120,
                'description'=>'Layered mango graham cake chilled to perfection.',
                'photo_url'=>'/images/items/mango-float.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Turon',
                'category'=>'dessert',
                'price'=>60,
                'description'=>'Banana wrapped in spring roll wrapper and fried with sugar.',
                'photo_url'=>'/images/items/turon.jpg',
                'serving'=>1
            ],


            /* DRINKS */

            [
                'name'=>'Kalamansi Juice',
                'category'=>'drink',
                'price'=>60,
                'description'=>'Refreshing citrus drink made from calamansi.',
                'photo_url'=>'/images/items/kalamansi-juice.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Buko Juice',
                'category'=>'drink',
                'price'=>70,
                'description'=>'Fresh coconut water served chilled.',
                'photo_url'=>'/images/items/buko-juice.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Sago’t Gulaman',
                'category'=>'drink',
                'price'=>60,
                'description'=>'Sweet Filipino drink with tapioca pearls and jelly.',
                'photo_url'=>'/images/items/sago-gulaman.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Mango Shake',
                'category'=>'drink',
                'price'=>80,
                'description'=>'Creamy mango smoothie with milk and ice.',
                'photo_url'=>'/images/items/mango-shake.jpg',
                'serving'=>1
            ],

            [
                'name'=>'Avocado Shake',
                'category'=>'drink',
                'price'=>90,
                'description'=>'Smooth avocado drink blended with milk and sugar.',
                'photo_url'=>'/images/items/avocado-shake.jpg',
                'serving'=>1
            ],

        ];

        foreach ($items as $item) {
            Item::create($item);
        }

    }
}