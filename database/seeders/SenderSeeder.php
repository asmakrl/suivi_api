<?php

namespace Database\Seeders;

use App\Models\Sender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sender::factory()->count(50)->create();
    }
}
