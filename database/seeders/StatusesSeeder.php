<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['status' => 'على قيد الدراسة'],
            ['status' => 'مغلق'],
            ];

        foreach ($data as $item){
            Status::create($item);
        }
    }
}
