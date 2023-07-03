<?php

namespace Modules\Package\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Package\Entities\Flight;
use Modules\Package\Entities\Station;
use Modules\Package\Entities\AirLines;
use Modules\Package\Entities\ArrivalStation;
use Modules\Package\Entities\TakeoffStation;
use Modules\Package\Entities\FlightTranslation;
use Modules\Package\Entities\StationTranslation;
use Modules\Package\Entities\AirLinesTranslation;
use Modules\Package\Entities\ArrivalStationTranslation;
use Modules\Package\Entities\TakeoffStationTranslation;

class FlightTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AirLines::insert([
            [
                'id' => 1
            ], [
                'id' => 2
            ]
        ]);

        AirLinesTranslation::insert([
            [
                'name' => 'cairo',
                'air_lines_id' => 1,
                'language_id' => 1,
            ], [
                'name' => 'القاهره',
                'air_lines_id' => 1,
                'language_id' => 2,
            ],
            [
                'name' => 'Alexandria',
                'air_lines_id' => 2,
                'language_id' => 1,
            ], [
                'name' => 'الأسكندرية',
                'air_lines_id' => 2,
                'language_id' => 2,
            ]
        ]);

        TakeoffStation::insert([
            [
                'id' => 1
            ], [
                'id' => 2
            ],
        ]);

        TakeoffStationTranslation::insert([
            [
                'name' => 'cairo',
                'takeoff_station_id' => 1,
                'language_id' => 1,
            ], [
                'name' => 'القاهره',
                'takeoff_station_id' => 1,
                'language_id' => 2,
            ],
            [
                'name' => 'Alexandria',
                'takeoff_station_id' => 2,
                'language_id' => 1,
            ], [
                'name' => 'الأسكندرية',
                'takeoff_station_id' => 2,
                'language_id' => 2,
            ]
        ]);

        ArrivalStation::insert([
            [
                'id' => 1
            ], [
                'id' => 2
            ],
        ]);

        ArrivalStationTranslation::insert([
            [
                'name' => 'cairo',
                'arrival_station_id' => 1,
                'language_id' => 1,
            ], [
                'name' => 'القاهره',
                'arrival_station_id' => 1,
                'language_id' => 2,
            ],
            [
                'name' => 'Alexandria',
                'arrival_station_id' => 2,
                'language_id' => 1,
            ], [
                'name' => 'الأسكندرية',
                'arrival_station_id' => 2,
                'language_id' => 2,
            ]
        ]);

        Flight::insert([
            [
                'id' => 1,
                'type' => 'going_only',
                'category' => 'economic',
                'traveling_date' => '2023-06-06',
                'return_date' => '2023-06-20',
                'price' => 1000,
                'image' => 'LkKrnh7xOxcoxLMTSOPdikjaf23VLOsBDMelgcCw.jpg',
                'destination_slug' => 'CAI',
                'arrival_time' => '8:00 PM',
                'arrival_station_id' => 1,
                'takeoff_station_id' => 1,
                'air_lines_id' => 1,
            ],
            [
                'id' => 2,
                'type' => 'going_only',
                'category' => 'economic',
                'traveling_date' => '2023-06-10',
                'return_date' => '2023-06-30',
                'price' => 3000,
                'image' => 'LkKrnh7xOxcoxLMTSOPdikjaf23VLOsBDMelgcCw.jpg',
                'destination_slug' => 'CAI',
                'arrival_time' => '8:00 AM',
                'arrival_station_id' => 2,
                'takeoff_station_id' => 2,
                'air_lines_id' => 2,
            ],
            [
                'id' => 3,
                'type' => 'going_and_return',
                'category' => 'business_men',
                'traveling_date' => '2023-06-06',
                'return_date' => '2023-06-20',
                'price' => 1000,
                'image' => 'LkKrnh7xOxcoxLMTSOPdikjaf23VLOsBDMelgcCw.jpg',
                'destination_slug' => 'CAI',
                'arrival_time' => '8:00 PM',
                'arrival_station_id' => 1,
                'takeoff_station_id' => 2,
                'air_lines_id' => 2,
            ],
            [
                'id' => 4,
                'type' => 'going_and_return',
                'category' => 'business_men',
                'traveling_date' => '2023-06-10',
                'return_date' => '2023-06-30',
                'price' => 3000,
                'image' => 'LkKrnh7xOxcoxLMTSOPdikjaf23VLOsBDMelgcCw.jpg',
                'destination_slug' => 'CAI',
                'arrival_time' => '8:00 AM',
                'arrival_station_id' => 2,
                'takeoff_station_id' => 1,
                'air_lines_id' => 1,
            ],
        ]);

        FlightTranslation::insert([
            [
                'company_name' => 'Cairo Air',
                'from_location' => 'Cairo',
                'to_location' => 'Sharm Elsheikh',
                'day' => 'Sunday',
                'price_currency' => 'EGP',
                'language_id' => 1,
                'flight_id' => 1,

            ],
            [
                'company_name' => 'مصر للطيران',
                'from_location' => 'القاهرة',
                'to_location' => 'شرم الشيخ',
                'day' => 'الاحد',
                'price_currency' => 'ج.م',
                'language_id' => 2,
                'flight_id' => 1,
            ],
            [
                'company_name' => 'Cairo Air',
                'from_location' => 'ِAlex',
                'to_location' => 'Hurgada',
                'day' => 'Tuesday',
                'price_currency' => 'EGP',
                'language_id' => 1,
                'flight_id' => 2,

            ],
            [
                'company_name' => 'مصر للطيران',
                'from_location' => 'القاهرة',
                'to_location' => 'شرم الشيخ',
                'day' => 'الاحد',
                'price_currency' => 'ج.م',
                'language_id' => 2,
                'flight_id' => 2,
            ],
            [
                'company_name' => 'Cairo Air',
                'from_location' => 'Saudi',
                'to_location' => 'Cairo',
                'day' => 'Sunday',
                'price_currency' => 'EGP',
                'language_id' => 1,
                'flight_id' => 3,

            ],
            [
                'company_name' => 'مصر للطيران',
                'from_location' => 'السعودية',
                'to_location' => 'القاهرة',
                'day' => 'الاحد',
                'price_currency' => 'ج.م',
                'language_id' => 2,
                'flight_id' => 3,
            ],
            [
                'company_name' => 'Cairo Air',
                'from_location' => 'Amman',
                'to_location' => 'Saudi',
                'day' => 'Sunday',
                'price_currency' => 'EGP',
                'language_id' => 1,
                'flight_id' => 4,

            ],
            [
                'company_name' => 'مصر للطيران',
                'from_location' => 'عمان',
                'to_location' => 'السعودية',
                'day' => 'الاحد',
                'price_currency' => 'ج.م',
                'language_id' => 2,
                'flight_id' => 4,
            ],

        ]);
    }
}
