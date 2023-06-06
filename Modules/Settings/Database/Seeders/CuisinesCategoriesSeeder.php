<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Entities\CategoryTranslation;
use Modules\Settings\Entities\CategoryTypeTranslation;

class CuisinesCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Cuisines Categories
         */
        Category::insert([
            ['id' => 20, 'category_type_id' => 7, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 21, 'category_type_id' => 7, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 22, 'category_type_id' => 7, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTranslation::insert([
            ['id' => 39,     'category_id' => 20, 'language_id' => 1, 'name' => 'Yemeni',       'slug' => 'yemeni',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 40,     'category_id' => 20, 'language_id' => 2, 'name' => 'يمني',         'slug' => 'يمني',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 41,     'category_id' => 21, 'language_id' => 1, 'name' => 'Arabi',        'slug' => 'arabi',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 42,     'category_id' => 21, 'language_id' => 2, 'name' => 'عربي',         'slug' => 'عربي',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 43,     'category_id' => 22, 'language_id' => 1, 'name' => 'Oriental',      'slug' => 'oriental',        'created_at' => now(), 'updated_at' => now()],
            ['id' => 44,     'category_id' => 22, 'language_id' => 2, 'name' => 'شرقي',         'slug' => 'شرقي',            'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
