<?php 

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Flower; // ใช้โมเดล Flower

class FlowerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // สร้างข้อมูล 10 แถวในตาราง flowers
        for ($i = 1; $i <= 10; $i++) {
            Flower::create([
                'name' => 'Flower ' . $i, // เปลี่ยนชื่อดอกไม้
                'description' => 'Description for flower ' . $i, // คำอธิบาย
                'price' => rand(100, 500), // ราคาสุ่มระหว่าง 100 ถึง 500
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
