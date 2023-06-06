<?php

namespace Modules\Locations\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Locations\Entities\City;
use Modules\Locations\Entities\State;
use Modules\Locations\Entities\Country;
use Modules\Locations\Entities\CityTranslation;
use Modules\Locations\Entities\StateTranslation;
use Modules\Locations\Entities\CountryTranslation;

class DefaultLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::create([
            'id' => 1,
            'is_active' => true,
            'phone_code' => '+967',
            'currency_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1
        ]);

        CountryTranslation::insert([
            ['id' => 1, 'language_id' => 1, 'country_id' => 1, 'name' => 'Yemen', 'nationality' => 'Yemeni', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'language_id' => 2, 'country_id' => 1, 'name' => 'اليمن', 'nationality' => 'يمنى',  'created_at' => now(), 'updated_at' => now()]
        ]);

        State::create([
            'id' => 1,
            'is_active' => true,
            'country_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1
        ]);

        StateTranslation::insert([
            ['id' => 1, 'language_id' => 1, 'state_id' => 1, 'name' => 'Sanaa', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'language_id' => 2, 'state_id' => 1, 'name' => 'صنعاء', 'created_at' => now(), 'updated_at' => now()]
        ]);

        City::create([
            'id' => 1,
            'is_active' => true,
            'state_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            'created_by' => 1,
            'updated_by' => 1
        ]);

        CityTranslation::insert([
            ['id' => 1, 'language_id' => 1, 'city_id' => 1, 'name' => 'Alsaafia', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'language_id' => 2, 'city_id' => 1, 'name' => 'الصافية', 'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
