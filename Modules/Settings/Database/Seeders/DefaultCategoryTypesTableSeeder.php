<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Entities\CategoryType;
use Modules\Settings\Entities\CategoryTypeTranslation;

class DefaultCategoryTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CategoryType::insert([
            ['id' => 1, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 2, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTypeTranslation::insert([
            ['id' => 1,     'category_type_id' => 1, 'language_id' => 1, 'name' => 'Blogs',             'created_at' => now(), 'updated_at' => now()],
            ['id' => 2,     'category_type_id' => 1, 'language_id' => 2, 'name' => 'المدونات',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 3,     'category_type_id' => 2, 'language_id' => 1, 'name' => 'FAQ',               'created_at' => now(), 'updated_at' => now()],
            ['id' => 4,     'category_type_id' => 2, 'language_id' => 2, 'name' => 'الاسئلة الشائعة',   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
