<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // สร้างผู้ใช้ 10 ราย
        User::factory()->count(10)->create();

        // เรียกใช้ FlowerSeeder
        $this->call(FlowerSeeder::class);
    }
}
