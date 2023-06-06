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
            ['id' => 3, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 4, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 5, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 6, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 7, 'is_active' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTypeTranslation::insert([
            ['id' => 1,     'category_type_id' => 1, 'language_id' => 1, 'name' => 'Products',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 2,     'category_type_id' => 1, 'language_id' => 2, 'name' => 'المنتجات',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 3,     'category_type_id' => 2, 'language_id' => 1, 'name' => 'Blogs',             'created_at' => now(), 'updated_at' => now()],
            ['id' => 4,     'category_type_id' => 2, 'language_id' => 2, 'name' => 'المدونات',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 5,     'category_type_id' => 3, 'language_id' => 1, 'name' => 'Vendors',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 6,     'category_type_id' => 3, 'language_id' => 2, 'name' => 'البائعين',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 7,     'category_type_id' => 4, 'language_id' => 1, 'name' => 'FAQ',               'created_at' => now(), 'updated_at' => now()],
            ['id' => 8,     'category_type_id' => 4, 'language_id' => 2, 'name' => 'الاسئلة الشائعة',   'created_at' => now(), 'updated_at' => now()],
            ['id' => 9,     'category_type_id' => 5, 'language_id' => 1, 'name' => 'Merchant',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 10,    'category_type_id' => 5, 'language_id' => 2, 'name' => 'التاجر',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 11,    'category_type_id' => 6, 'language_id' => 1, 'name' => 'Meals',              'created_at' => now(), 'updated_at' => now()],
            ['id' => 12,    'category_type_id' => 6, 'language_id' => 2, 'name' => 'الوجبات',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 13,    'category_type_id' => 7, 'language_id' => 1, 'name' => 'Cuisines',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 14,    'category_type_id' => 7, 'language_id' => 2, 'name' => 'المطابخ',           'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
