<?php

namespace Database\Seeders;

use \App\Models\User;
use \App\Models\Provider;
use \App\Models\Product;
use \App\Models\ProductRating;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::truncate();
        Provider::truncate();
        Product::truncate();
        ProductRating::truncate();

        
        $user = User::create([
            'name' => 'Jana',
            'email' => 'stankovicjana000@gmail.com',
            'password' => Hash::make('Jana000!'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);

        $user = User::create([
            'name' => 'Jana',
            'email' => 'stankovic@gmail.com',
            'password' => Hash::make('Sifra123!'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'role' => 'admin'
        ]);
      


        User::factory(5)->create();
        Provider::factory(10)->create();

        
        $product1 = Product::create([
          
            'name' => 'Naocare'
        ]);

        $product2 = Product::create([
            'name' => 'Krema za ruke'
        ]);

        $product3 = Product::create([
            'name' => 'Krema za lice'
        ]);

        $product4 = Product::create([
            'name' => 'Micelarna voda'
        ]);

        $product5 = Product::create([
            'name' => 'Četka za kosu'
        ]);
        
        $productRating1 = ProductRating::create([
            'date_and_time' => now(),
            'user' =>3,
            'product' =>1,
            'provider' => 1,
            'rating' => 5,
            'note' =>  'Savršena kozmetika, probala za sada kremu za lice 45+ i piling za telo. Retko kada mi se desilo da budem oduševljena i zadovoljna kada probam neku novu kremu/liniju kozm. ali sa HOMMAGE sam prezadovoljna. Za svaku preporuku!'
        ]);

        $productRating1 = ProductRating::create([
            'date_and_time' => now(),
            'user' =>4,
            'product' =>1,
            'provider' => 1,
            'rating' => 5,
            'note' => 'Savršena kozmetika, probala za sada kremu za lice 45+ i piling za telo. Retko kada mi se desilo da budem oduševljena i zadovoljna kada probam neku novu kremu/liniju kozm. ali sa HOMMAGE sam prezadovoljna. Za svaku preporuku!'
        ]);

        $productRating3 = ProductRating::create([
            'date_and_time' => now(),
            'user' =>5,
            'product' =>1,
            'provider' => 1,
            'rating' => 5,
            'note' => 'Savršena kozmetika, probala za sada kremu za lice 45+ i piling za telo. Retko kada mi se desilo da budem oduševljena i zadovoljna kada probam neku novu kremu/liniju kozm. ali sa HOMMAGE sam prezadovoljna. Za svaku preporuku!'
        ]);
       

    }
}
