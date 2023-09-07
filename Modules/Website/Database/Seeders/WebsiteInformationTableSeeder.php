<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Website\Entities\WebsiteInformation;
use Modules\Website\Entities\WebsiteInformationTranslation;

class WebsiteInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $website_information = WebsiteInformation::create([
            'main_logo' => null,
            'footer_logo' => null,
            'facebook_pixel_code' => null,
            'google_analytics_code' => null,
            'address_google_map_link' => 'https://goo.gl/maps/XekQe2kbgw8WVrmS9',
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        WebsiteInformationTranslation::insert([
            ['website_information_id' => $website_information->id, 'language_id' => 1, 'name' => 'Asrar Altayyar', 'address' => 'Sheikh Hussein Street - King Abdullah Road - Al Hamra District - Riyadh - Saudi Arabia'],
            ['website_information_id' => $website_information->id, 'language_id' => 2, 'name' => 'اسرار الطيار', 'address' => 'شارع الشيخ حسين - طريق الملك عبدالله - حى الحمراء - الرياض - السعودية']
        ]);
    }
}
