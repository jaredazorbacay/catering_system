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

            ['name'=>'Adobo','category'=>'food','price'=>150,'description'=>'Classic Filipino dish cooked in soy sauce, vinegar and garlic.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/3/38/Chicken_adobo.jpg/1920px-Chicken_adobo.jpg'],

            ['name'=>'Sinigang','category'=>'food','price'=>150,'description'=>'Filipino sour tamarind soup with vegetables and meat.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Sinigang_na_Baboy.jpg/1280px-Sinigang_na_Baboy.jpg'],

            ['name'=>'Kare-Kare','category'=>'food','price'=>180,'description'=>'Peanut stew with vegetables served with shrimp paste.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5a/Kare-kare.jpg/640px-Kare-kare.jpg'],

            ['name'=>'Lechon','category'=>'food','price'=>300,'description'=>'Crispy roasted pig commonly served during celebrations.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a3/Lechon_Baboy%2C_June_2025_%281%29.jpg/640px-Lechon_Baboy%2C_June_2025_%281%29.jpg'],

            ['name'=>'Pancit Canton','category'=>'food','price'=>120,'description'=>'Stir-fried egg noodles with vegetables and meat.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f0/Pancit_canton.jpg/640px-Pancit_canton.jpg'],

            ['name'=>'Pancit Bihon','category'=>'food','price'=>120,'description'=>'Rice noodle dish with vegetables and meat.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Pancit_Bihon_Guisado_Recipe.jpg/640px-Pancit_Bihon_Guisado_Recipe.jpg'],

            ['name'=>'Bulalo','category'=>'food','price'=>200,'description'=>'Beef marrow soup simmered for hours with vegetables.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/6/66/Bulalo_%28Philippines%29.jpg/640px-Bulalo_%28Philippines%29.jpg'],

            ['name'=>'Tinola','category'=>'food','price'=>150,'description'=>'Chicken soup with ginger, green papaya and chili leaves.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/Tinolalunch.jpg/640px-Tinolalunch.jpg'],

            ['name'=>'Afritada','category'=>'food','price'=>150,'description'=>'Tomato based chicken stew with vegetables.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Chicken_afritada_with_pineapple_%28Philippines%29.jpg/640px-Chicken_afritada_with_pineapple_%28Philippines%29.jpg'],

            ['name'=>'Menudo','category'=>'food','price'=>150,'description'=>'Pork stew with liver, potatoes and tomato sauce.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e0/Pork_Menudo_%28Filipino_Pork_Stew%29.jpg/640px-Pork_Menudo_%28Filipino_Pork_Stew%29.jpg'],

            ['name'=>'Mechado','category'=>'food','price'=>170,'description'=>'Beef stew cooked slowly in tomato sauce.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c9/Cooked_mechado_2.JPG/640px-Cooked_mechado_2.JPG'],

            ['name'=>'Kaldereta','category'=>'food','price'=>170,'description'=>'Rich goat or beef stew with liver spread and vegetables.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/8/87/Beef_caldereta_from_the_Philippines.jpg/640px-Beef_caldereta_from_the_Philippines.jpg'],

            ['name'=>'Bistek Tagalog','category'=>'food','price'=>170,'description'=>'Beef steak marinated in soy sauce with onions.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Bistek_Tagalog-02.jpg/640px-Bistek_Tagalog-02.jpg'],

            ['name'=>'Sisig','category'=>'food','price'=>160,'description'=>'Sizzling pork dish seasoned with calamansi and chili.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0f/Sisig_wikipedia.jpg/640px-Sisig_wikipedia.jpg'],

            ['name'=>'Pinakbet','category'=>'food','price'=>120,'description'=>'Mixed vegetable dish flavored with shrimp paste.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e2/Solaire_Resort_North_Food_court_11_January_2025_PinakbetE.jpg/640px-Solaire_Resort_North_Food_court_11_January_2025_PinakbetE.jpg'],

            ['name'=>'Dinuguan','category'=>'food','price'=>140,'description'=>'Savory pork stew cooked in pig blood and vinegar.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0b/Dinuguan_with_Sili.jpg/640px-Dinuguan_with_Sili.jpg'],

            ['name'=>'Chicken Inasal','category'=>'food','price'=>170,'description'=>'Grilled chicken marinated in citrus and annatto oil.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b7/9780Chicken_Inasal_03.jpg/640px-9780Chicken_Inasal_03.jpg'],

            ['name'=>'Crispy Pata','category'=>'food','price'=>300,'description'=>'Deep fried pork leg with crispy skin.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1d/Patio_Filipino_crispy_pata.JPG/640px-Patio_Filipino_crispy_pata.JPG'],

            ['name'=>'Fried Chicken Filipino Style','category'=>'food','price'=>150,'description'=>'Golden fried chicken seasoned Filipino style.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d8/Fried_chicken_%2825163375255%29.jpg/640px-Fried_chicken_%2825163375255%29.jpg'],

            ['name'=>'Fried Tilapia','category'=>'food','price'=>140,'description'=>'Whole tilapia fried until crispy.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/0/0e/Fried_Tilapia_Fish.jpg/640px-Fried_Tilapia_Fish.jpg'],

            ['name'=>'Fried Bangus','category'=>'food','price'=>150,'description'=>'Milkfish fried to perfection.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/e/ea/BONELESS_BANGUS_%284946233351%29.jpg/640px-BONELESS_BANGUS_%284946233351%29.jpg'],


            /* DESSERTS */

            ['name'=>'Halo-Halo','category'=>'dessert','price'=>120,'description'=>'Shaved ice dessert with fruits, beans and milk.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/3/30/Halo_halo1.jpg/640px-Halo_halo1.jpg'],

            ['name'=>'Mais Con Yelo','category'=>'dessert','price'=>100,'description'=>'Sweet corn dessert served with shaved ice and milk.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/7/76/Mais_con_yelo.jpg/640px-Mais_con_yelo.jpg'],

            ['name'=>'Taho','category'=>'dessert','price'=>50,'description'=>'Soft tofu dessert with syrup and tapioca pearls.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/9/91/Taho%2C_Apr_2024.jpg/640px-Taho%2C_Apr_2024.jpg'],

            ['name'=>'Leche Flan','category'=>'dessert','price'=>90,'description'=>'Creamy caramel custard dessert.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/b/b8/Leche_flan_Filipinas.jpg/640px-Leche_flan_Filipinas.jpg'],

            ['name'=>'Ube Halaya','category'=>'dessert','price'=>120,'description'=>'Sweet purple yam jam dessert.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Ube_halaya_-_mashed_purple_yam_%28Philippines%29_02.jpg/640px-Ube_halaya_-_mashed_purple_yam_%28Philippines%29_02.jpg'],

            ['name'=>'Mango Float','category'=>'dessert','price'=>140,'description'=>'Layered mango graham cake chilled to perfection.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/Mango_float%2C_a_Filipino_icebox_cake_version_of_Crema_de_Fruta_02.jpg/640px-Mango_float%2C_a_Filipino_icebox_cake_version_of_Crema_de_Fruta_02.jpg'],

            ['name'=>'Turon','category'=>'dessert','price'=>60,'description'=>'Banana wrapped in spring roll wrapper and fried with sugar.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9c/Turon_with_ube_sauce_from_Filipino_Festival_at_the_Queen_Victoria_Market%2C_Melbourne.jpg/640px-Turon_with_ube_sauce_from_Filipino_Festival_at_the_Queen_Victoria_Market%2C_Melbourne.jpg'],


            /* DRINKS */

            ['name'=>'Kalamansi Juice','category'=>'drink','price'=>60,'description'=>'Refreshing citrus drink made from calamansi.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f3/Calamansi_juice_%28Philippines%29.jpg/640px-Calamansi_juice_%28Philippines%29.jpg'],

            ['name'=>'Buko Juice','category'=>'drink','price'=>70,'description'=>'Fresh coconut water served chilled.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Coconut_Drink%2C_Pangandaran.JPG/640px-Coconut_Drink%2C_Pangandaran.JPG'],

            ['name'=>'Sago’t Gulaman','category'=>'drink','price'=>60,'description'=>'Sweet Filipino drink with tapioca pearls and jelly.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/Sasa_asian_cuisine_merienda-14.jpg/640px-Sasa_asian_cuisine_merienda-14.jpg'],

            ['name'=>'Mango Shake','category'=>'drink','price'=>80,'description'=>'Creamy mango smoothie with milk and ice.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/3/3d/Mango_shake.jpg/1920px-Mango_shake.jpg'],

            ['name'=>'Avocado Shake','category'=>'drink','price'=>90,'description'=>'Smooth avocado drink blended with milk and sugar.','photo_url'=>'https://upload.wikimedia.org/wikipedia/commons/thumb/3/32/Sa_sa_batido.jpeg/640px-Sa_sa_batido.jpeg'],

        ];

        foreach ($items as $item) {

            Item::create($item);

        }

    }
}