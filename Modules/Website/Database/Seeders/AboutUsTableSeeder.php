<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Website\Entities\AboutUs;
use Modules\Website\Entities\AboutUsTranslation;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aboutUs =  AboutUs::create([
            'id' => 1
        ]);;

        $translations = [
            [
                'title' => 'Brief history of the company',
                'description' => 'Aviation Services for Aviation offers airlines for flying, international licenses for flying, air services, international licenses for the best prices, hotels, cruises, international licenses for aviation, international licenses for flying at the best prices, flights, flights and cruises at the best prices',
                'language_id' => 1,
                'about_us_id' => $aboutUs->id
            ],
            [
                'title' => 'نبذة عن تاريخ الشركة',
                'description' => 'تقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعارتقدم أسرار الطيار خدمات الحجز الالكترونى للطيران والفنادق و الرحلات البحرية و التأشيرات و الرخص الدولية بأفضل الأسعار ',
                'language_id' => 2,
                'about_us_id' => $aboutUs->id
            ]

        ];

        AboutUsTranslation::insert($translations);
    }
}
