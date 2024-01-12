<?php

namespace Database\Seeders;

use App\Models\Requests;
use Illuminate\Database\Seeder;


class RequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Requests::factory()->count(50)->create();

        }

}
