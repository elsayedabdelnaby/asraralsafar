<?php

namespace Modules\Package\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Package\Entities\Package;
use Illuminate\Database\Eloquent\Model;
use Modules\Package\Entities\PackageTranslation;

class PackageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $package = Package::create([
            'image' => 'LkKrnh7xOxcoxLMTSOPdikjaf23VLOsBDMelgcCw.jpg',
            'number_of_days' => 2,
            'number_of_clients' => 2,
            'number_of_meals' => 2,
            'price' => 300,
            'traveling_date' => '2023-06-06',
            'return_date' => '2023-06-06',
            'country_id' => 1,
            'meeting_time' => '2023-06-06 12:34:56',
            'departure_time' => '2023-06-06 12:34:56',
            'price_includes' => json_encode(['Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy', 'Lorem Ipsum is simply dummy']),
        ]);

        $translationEn = new PackageTranslation();
        $translationEn->title = 'Lorem Ipsum is simply dummy';
        $translationEn->description = 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy';
        $translationEn->traveling_location = 'Lorem Ipsum is simply dummy';
        $translationEn->type_of_rooms = 'Lorem Ipsum is simply dummy';
        $translationEn->language_id = 1;

        $translationAr = new PackageTranslation();
        $translationAr->title = 'Lorem Ipsum is simply dummy';
        $translationAr->description = 'Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy Lorem Ipsum is simply dummy';
        $translationAr->traveling_location = 'Lorem Ipsum is simply dummy';
        $translationAr->type_of_rooms = 'Lorem Ipsum is simply dummy';
        $translationAr->language_id = 2;

        $package->translations()->saveMany([$translationEn, $translationAr]);
    }
}
