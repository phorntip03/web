<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FlowerShop; // Use the correct model
use Faker\Factory as Faker;

class FlowerShopSeeder extends Seeder
{
    /**
     * Run the database seeds for the FlowerShop.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            FlowerShop::create([ // Use the correct model 'FlowerShop'
                'name' => $faker->word, // Random flower product names
                'description' => $faker->sentence, // Random flower product description
                'price' => $faker->randomFloat(2, 100, 1000), // Price range for premium flower products (100 to 1000)
                'created_at' => now(), // Current timestamp
                'updated_at' => now(), // Current timestamp
            ]);
        }
    }
}
