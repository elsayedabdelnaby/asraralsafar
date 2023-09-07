<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Website\Entities\Statistic;
use Modules\Website\Entities\StatisticTranslation;

class StatisticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statistic =  Statistic::create([
            'id' => 1,
            'is_active' => true,
            'number' => 20,
            'display_order' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $translations = [
            [
                'title' => 'سنوات الخبرة',
                'language_id' => 2,
                'statistic_id' => $statistic->id
            ],
            [
                'title' => 'Years Experiences',
                'language_id' => 1,
                'statistic_id' => $statistic->id
            ]

        ];

        StatisticTranslation::insert($translations);


        $statistic =  Statistic::create([
            'id' => 2,
            'is_active' => true,
            'number' => 530,
            'display_order' => 2,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $translations = [
            [
                'title' => 'برامج سياحية',
                'language_id' => 2,
                'statistic_id' => $statistic->id
            ],
            [
                'title' => 'Tour Packages',
                'language_id' => 1,
                'statistic_id' => $statistic->id
            ]

        ];

        StatisticTranslation::insert($translations);


        $statistic =  Statistic::create([
            'id' => 3,
            'is_active' => true,
            'number' => 850,
            'display_order' => 3,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $translations = [
            [
                'title' => 'الزبائن السعداء',
                'language_id' => 2,
                'statistic_id' => $statistic->id
            ],
            [
                'title' => 'Happy Customers',
                'language_id' => 1,
                'statistic_id' => $statistic->id
            ]

        ];

        StatisticTranslation::insert($translations);

        $statistic =  Statistic::create([
            'id' => 4,
            'is_active' => true,
            'number' => 320,
            'display_order' => 4,
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        $translations = [
            [
                'title' => 'الحائز على جائزة',
                'language_id' => 2,
                'statistic_id' => $statistic->id
            ],
            [
                'title' => 'Award Winning',
                'language_id' => 1,
                'statistic_id' => $statistic->id
            ]

        ];

        StatisticTranslation::insert($translations);

    }
}
