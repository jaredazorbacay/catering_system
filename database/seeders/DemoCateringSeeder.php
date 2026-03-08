<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Item;
use Illuminate\Support\Facades\Hash;

class DemoCateringSeeder extends Seeder
{

    public function run(): void
    {

        /*
        |--------------------------------------------------------------------------
        | CREATE ADMIN USER
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'System Administrator',
            'phone_number' => '0908',
            'address' => 'Admin Office',
            'password' => Hash::make('admin123'),
            'role' => 'admin'
        ]);



        /*
        |--------------------------------------------------------------------------
        | CLIENT DATA
        |--------------------------------------------------------------------------
        */

        $items = Item::all();

        $names = [
            "Maria Santos",
            "Juan Dela Cruz",
            "Ana Reyes",
            "Mark Bautista",
            "Jared Lim",
            "Samantha Cruz",
            "Michael Tan",
            "Carlo Mendoza",
            "Angela Garcia",
            "Daniel Ramos"
        ];

        $eventTypes = [
            "Birthday Celebration",
            "Wedding Reception",
            "Corporate Seminar",
            "Family Reunion",
            "Baptism Party",
            "Graduation Celebration",
            "Company Anniversary",
            "Engagement Party",
            "Christmas Party",
            "House Blessing"
        ];

        $locations = [
            "Cebu City Hall",
            "SM Convention Center",
            "Waterfront Hotel Ballroom",
            "Marco Polo Plaza Cebu",
            "Lapu-Lapu City Pavilion",
            "Ayala Terraces Garden",
            "Mandaue Sports Complex",
            "Grand Convention Center",
            "Radisson Blu Ballroom",
            "Family Residence Garden"
        ];


        foreach($names as $name){

            $user = User::create([
                'name' => $name,
                'phone_number' => '0917'.rand(1000000,9999999),
                'address' => 'Cebu City',
                'password' => Hash::make('password'),
                'role' => 'client'
            ]);


            $orderCount = rand(1,3);

            for ($o = 1; $o <= $orderCount; $o++) {

                $eventName = $eventTypes[array_rand($eventTypes)];

                $order = Order::create([
                    'user_id' => $user->id,
                    'event_name' => $eventName,
                    'event_date' => now()->addDays(rand(5,90)),
                    'event_location' => $locations[array_rand($locations)],
                    'guest_count' => rand(60,250),
                    'status' => collect(['pending','approved','cancelled'])->random()
                ]);


                $selectedItems = $items->random(rand(5,17));

                foreach($selectedItems as $item){

                    OrderItem::create([
                        'order_id' => $order->id,
                        'item_id' => $item->id,
                        'quantity' => rand(1,5),
                        'price' => $item->price
                    ]);

                }

            }

        }

    }

}