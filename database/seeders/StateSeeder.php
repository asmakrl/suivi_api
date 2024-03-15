<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //State::factory()->count(50)->create();
        $data = [
            ['code' => 1, 'nomFr' => 'Adrar', 'nomAr' => 'أدرار'],
            ['code' => 2, 'nomFr' => 'Chlef', 'nomAr' => 'الشلف'],
            ['code' => 3, 'nomFr' => 'Laghouat', 'nomAr' => 'الأغواط'],
            ['code' => 4, 'nomFr' => 'Oum El Bouaghi', 'nomAr' => 'أم البواقي'],
            ['code' => 5, 'nomFr' => 'Batna', 'nomAr' => 'باتنة'],
            ['code' => 6, 'nomFr' => 'Béjaïa', 'nomAr' => ' بجاية'],
            ['code' => 7, 'nomFr' => 'Biskra', 'nomAr' => 'بسكرة'],
            ['code' => 8, 'nomFr' => 'Béchar', 'nomAr' => 'بشار'],
            ['code' => 9, 'nomFr' => 'Blida', 'nomAr' => 'البليدة'],
            ['code' => 10, 'nomFr' => 'Bouira', 'nomAr' => 'البويرة'],
            ['code' => 11, 'nomFr' => 'Tamanrasset', 'nomAr' => 'تمنراست'],
            ['code' => 12, 'nomFr' => 'Tébessa', 'nomAr' => 'تبسة'],
            ['code' => 13, 'nomFr' => 'Tlemcen', 'nomAr' => 'تلمسان'],
            ['code' => 14, 'nomFr' => 'Tiaret', 'nomAr' => 'تيارت'],
            ['code' => 15, 'nomFr' => 'Tizi Ouzou', 'nomAr' => 'تيزي وزو'],
            ['code' => 16, 'nomFr' => 'Alger', 'nomAr' => 'الجزائر'],
            ['code' => 17, 'nomFr' => 'Djelfa', 'nomAr' => 'الجلفة'],
            ['code' => 18, 'nomFr' => 'Jijel', 'nomAr' => 'جيجل'],
            ['code' => 19, 'nomFr' => 'Sétif', 'nomAr' => 'سطيف'],
            ['code' => 20, 'nomFr' => 'Saïda', 'nomAr' => 'سعيدة'],
            ['code' => 21, 'nomFr' => 'Skikda', 'nomAr' => 'سكيكدة'],
            ['code' => 22, 'nomFr' => 'Sidi Bel Abbès', 'nomAr' => 'سيدي بلعباس'],
            ['code' => 23, 'nomFr' => 'Annaba', 'nomAr' => 'عنابة'],
            ['code' => 24, 'nomFr' => 'Guelma', 'nomAr' => 'قالمة'],
            ['code' => 25, 'nomFr' => 'Constantine', 'nomAr' => 'قسنطينة'],
            ['code' => 26, 'nomFr' => 'Médéa', 'nomAr' => 'المدية'],
            ['code' => 27, 'nomFr' => 'Mostaganem', 'nomAr' => 'مستغانم'],
            ['code' => 28, 'nomFr' => 'M\'Sila', 'nomAr' => 'المسيلة'],
            ['code' => 29, 'nomFr' => 'Mascara', 'nomAr' => 'معسكر'],
            ['code' => 30, 'nomFr' => 'Ouargla', 'nomAr' => 'ورقلة'],
            ['code' => 31, 'nomFr' => 'Oran', 'nomAr' => 'وهران'],
            ['code' => 32, 'nomFr' => 'El Bayadh', 'nomAr' => 'البيض'],
            ['code' => 33, 'nomFr' => 'Illizi', 'nomAr' => 'إليزي'],
            ['code' => 34, 'nomFr' => 'Bordj Bou Arreridj', 'nomAr' => 'برج بوعريريج'],
            ['code' => 35, 'nomFr' => 'Boumerdès', 'nomAr' => 'بومرداس'],
            ['code' => 36, 'nomFr' => 'El Tarf', 'nomAr' => 'الطارف'],
            ['code' => 37, 'nomFr' => 'Tindouf', 'nomAr' => 'تندوف'],
            ['code' => 38, 'nomFr' => 'Tissemsilt', 'nomAr' => 'تيسمسيلت'],
            ['code' => 39, 'nomFr' => 'El Oued', 'nomAr' => 'الوادي'],
            ['code' => 40, 'nomFr' => 'Khenchela', 'nomAr' => 'خنشلة'],
            ['code' => 41, 'nomFr' => 'Souk Ahras', 'nomAr' => 'سوق أهراس'],
            ['code' => 42, 'nomFr' => 'Tipaza', 'nomAr' => 'تيبازة'],
            ['code' => 43, 'nomFr' => 'Mila', 'nomAr' => 'ميلة'],
            ['code' => 44, 'nomFr' => 'Aïn Defla', 'nomAr' => 'عين الدفلى'],
            ['code' => 45, 'nomFr' => 'Naâma', 'nomAr' => 'النعامة'],
            ['code' => 46, 'nomFr' => 'Aïn Témouchent', 'nomAr' => 'عين تموشنت'],
            ['code' => 47, 'nomFr' => 'Ghardaïa', 'nomAr' => 'غرداية'],
            ['code' => 48, 'nomFr' => 'Relizane', 'nomAr' => 'غليزان'],
            ['code' => 49, 'nomFr' => 'Timimoun', 'nomAr' => 'تيميمون'],
            ['code' => 50, 'nomFr' => 'Bordj Badji Mokhtar', 'nomAr' => 'برج باجي مختار'],
            ['code' => 51, 'nomFr' => 'Ouled Djellal', 'nomAr' => 'أولاد جلال'],
            ['code' => 52, 'nomFr' => 'Béni Abbès', 'nomAr' => 'بني عباس'],
            ['code' => 53, 'nomFr' => 'In Salah', 'nomAr' => 'عين صالح'],
            ['code' => 54, 'nomFr' => 'In Guezzam ', 'nomAr' => 'عين قزام'],
            ['code' => 55, 'nomFr' => 'Touggourt', 'nomAr' => 'تقرت'],
            ['code' => 56, 'nomFr' => 'Djanet', 'nomAr' => 'جانت'],
            ['code' => 57, 'nomFr' => 'El M\'Ghair', 'nomAr' => 'المغير'],
            ['code' => 58, 'nomFr' => 'El Meniaa', 'nomAr' => 'المنيعة']
        ];

        foreach ($data as $item){
            State::create($item);
        }
    }
}
