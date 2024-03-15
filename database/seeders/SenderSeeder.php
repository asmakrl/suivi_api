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
        $data = [
            ['name' => 'الوزير', 'category_id'=>1],
            ['name' => 'الأمين العام','category_id'=>1],
            ['name' => 'رئيس الديوان', 'category_id'=>1],
            ['name' => 'المدير العام للتعليم والتكوين', 'category_id'=>1],
            ['name' => 'المدير العام للبحث العلمي والتطوير التكنولوجي', 'category_id'=>1],
            ['name' => 'مدير الموارد البشرية', 'category_id'=>1],
            ['name' => 'مدير المالية', 'category_id'=>1],
            ['name' => 'مدير الوسائل والممتلكات والعقود', 'category_id'=>1],
            ['name' => 'مدير الحياة الطلابية', 'category_id'=>1],
            ['name' => 'مدير التعاون والتبادل الجامعي', 'category_id'=>1],
            ['name' => 'مدير الشبكات وتطوير الرقمنة', 'category_id'=>1],
            ['name' => 'مدير التخطيط والاستشراف', 'category_id'=>1],
            ['name' => 'مدير الشؤون القانونية', 'category_id'=>1],
            ['name' => 'المدير العام للديوان الوطني للخدمات الجامعية', 'category_id'=>1],
            ['name' => 'المدير العام لديوان المطبوعات الجامعية', 'category_id'=>1],
        ];


        foreach ($data as $item){
           Sender::create($item);
        }
    }
}
