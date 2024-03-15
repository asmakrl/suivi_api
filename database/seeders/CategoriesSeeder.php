<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Category::factory()->count(50)->create();
        $data = [
            ['category' => 'المديريات'],
            ['category' => 'المفتشين'],
            ['category' => 'هيئة نظامية'],
            ['category' => 'جامعة'],
            ['category' => 'مركز جامعي'],
            ['category' => 'مدرسة عليا'],
            ['category' => 'مدرسة وطنية عليا'],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
