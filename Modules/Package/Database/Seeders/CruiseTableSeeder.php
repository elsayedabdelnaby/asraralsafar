<?php

namespace Modules\Package\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Package\Entities\Cruise;
use Modules\Package\Entities\CruiseFeature;
use Modules\Package\Entities\CruiseFeatureTranslation;
use Modules\Package\Entities\CruiseTranslation;

class CruiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cruise::insert([
            [
                'id' => 1,
                'date' => '2023-06-20',
                'start_from_price' => '2000',
                'price' => 3000,
                'country_id' => 1

            ],
            [
                'id' => 2,
                'date' => '2023-07-30',
                'start_from_price' => '4000',
                'price' => 6000,
                'country_id' => 1
            ]
        ]);

        CruiseTranslation::insert([
            [
                'name' => 'Lorem Ipsum is simply dummy text of the printing and typesettin',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin',
                'take_off_location' => '',
                'language_id' => 1,
                'cruise_id' => 1,
            ],
            [
                'name' => 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                'description' => 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                'take_off_location' => '',
                'language_id' => 2,
                'cruise_id' => 1,
            ],
            [
                'name' => 'Lorem Ipsum is simply dummy text of the printing and typesettin',
                'description' => 'Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin Lorem Ipsum is simply dummy text of the printing and typesettin',
                'take_off_location' => '',
                'language_id' => 1,
                'cruise_id' => 2,
            ],
            [
                'name' => 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                'description' => 'وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم وريم ايبسوم هو نموذج افتراضي يوضع في التصاميم',
                'take_off_location' => '',
                'language_id' => 2,
                'cruise_id' => 2,
            ]
        ]);
    }
}
