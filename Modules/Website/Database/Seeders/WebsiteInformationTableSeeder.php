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
            'created_by' => 1,
            'updated_by' => 1,
        ]);
        WebsiteInformationTranslation::insert([
            ['website_information_id' => $website_information->id, 'language_id' => 1, 'name' => 'Wagbat'],
            ['website_information_id' => $website_information->id, 'language_id' => 2, 'name' => 'وجبات']
        ]);
    }
}
