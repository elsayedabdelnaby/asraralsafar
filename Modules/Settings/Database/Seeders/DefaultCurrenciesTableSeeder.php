<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Entities\Currency;
use Modules\Settings\Entities\CurrencyTranslation;

class DefaultCurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::insert([
            [
                'id' => 1,
                'iso_code' => 'YER',
                'symbol' => '﷼',
                'is_main' => true,
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1
            ],
            [
                'id' => 2,
                'iso_code' => 'USD',
                'is_main' => false,
                'symbol' => '$',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 1,
                'updated_by' => 1
            ]
        ]);

        CurrencyTranslation::insert([
            ['currency_id' => 1, 'language_id' => 1, 'name' => 'Yemen Rial',            'created_at' => now(), 'updated_at' => now()],
            ['currency_id' => 1, 'language_id' => 2, 'name' => 'ريال يمنى',             'created_at' => now(), 'updated_at' => now()],
            ['currency_id' => 2, 'language_id' => 1, 'name' => 'United States Dollar',  'created_at' => now(), 'updated_at' => now()],
            ['currency_id' => 2, 'language_id' => 2, 'name' => 'دولار امريكى',          'created_at' => now(), 'updated_at' => now()]
        ]);
    }
}
