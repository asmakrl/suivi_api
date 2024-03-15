<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Type::factory()->count(50)->create();
        $data = [
            ['action_type' => 'بريد الكتروني'],
            ['action_type' => 'اتصال هاتفي'],
            //['action_type' => 'مغلق'],
        ];

        foreach ($data as $item) {
            Type::create($item);
        }
    }
}
