<?php

namespace Modules\Settings\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Settings\Entities\Category;
use Modules\Settings\Entities\CategoryTranslation;

class DefaultCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Product Categories
         */
        //Three Main Categories
        Category::insert([
            ['id' => 1, 'category_type_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 2, 'category_type_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 3, 'category_type_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTranslation::insert([
            ['id' => 1,     'category_id' => 1, 'language_id' => 1, 'name' => 'Restaurant',       'slug' => 'restaurant',      'created_at' => now(), 'updated_at' => now()],
            ['id' => 2,     'category_id' => 1, 'language_id' => 2, 'name' => 'المطعم',          'slug' => 'المطعم',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 3,     'category_id' => 2, 'language_id' => 1, 'name' => 'Bakery',          'slug' => 'bakery',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 4,     'category_id' => 2, 'language_id' => 2, 'name' => 'المخبز',          'slug' => 'المخبز',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 5,     'category_id' => 3, 'language_id' => 1, 'name' => 'Grocery',         'slug' => 'grocery',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 6,     'category_id' => 3, 'language_id' => 2, 'name' => 'البقالة',         'slug' => 'البقالة',         'created_at' => now(), 'updated_at' => now()],
        ]);

        //
        Category::insert([
            ['id' => 4,  'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 5,  'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 6,  'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 7,  'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 8,  'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 9,  'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 10, 'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 11, 'category_type_id' => 1, 'parent_id' => 1, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTranslation::insert([
            ['id' => 7,     'category_id' => 4,  'language_id' => 1, 'name' => 'Prost',          'slug' => 'prost',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 8,     'category_id' => 4,  'language_id' => 2, 'name' => 'بروست',          'slug' => 'بروست',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 9,     'category_id' => 5,  'language_id' => 1, 'name' => 'Salad',          'slug' => 'salad',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 10,    'category_id' => 5,  'language_id' => 2, 'name' => 'سلطات',          'slug' => 'سلطات',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 11,    'category_id' => 6,  'language_id' => 1, 'name' => 'Grills',         'slug' => 'grills',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 12,    'category_id' => 6,  'language_id' => 2, 'name' => 'مشاوى',          'slug' => 'مشاوى',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 13,    'category_id' => 7,  'language_id' => 1, 'name' => 'Burger',         'slug' => 'burger',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 14,    'category_id' => 7,  'language_id' => 2, 'name' => 'برجر',           'slug' => 'برجر',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 15,    'category_id' => 8,  'language_id' => 1, 'name' => 'Pizza',          'slug' => 'pizza',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 16,    'category_id' => 8,  'language_id' => 2, 'name' => 'بيتزا',          'slug' => 'بيتزا',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 17,    'category_id' => 9,  'language_id' => 1, 'name' => 'Sandwiches',     'slug' => 'sandwiches',     'created_at' => now(), 'updated_at' => now()],
            ['id' => 18,    'category_id' => 9,  'language_id' => 2, 'name' => 'سندويتشات',      'slug' => 'سندويتشات',     'created_at' => now(), 'updated_at' => now()],
            ['id' => 19,    'category_id' => 10, 'language_id' => 1, 'name' => 'Ice Cream',      'slug' => 'ice-cream',      'created_at' => now(), 'updated_at' => now()],
            ['id' => 20,    'category_id' => 10, 'language_id' => 2, 'name' => 'ايس كريم',       'slug' => 'ايس كريم',      'created_at' => now(), 'updated_at' => now()],
            ['id' => 21,    'category_id' => 11, 'language_id' => 1, 'name' => 'Sweets',         'slug' => 'sweets',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 22,    'category_id' => 11, 'language_id' => 2, 'name' => 'حلويات',         'slug' => 'حلويات',        'created_at' => now(), 'updated_at' => now()],
        ]);

        /**
         * Merchant Categories
         */
        Category::insert([
            ['id' => 12, 'category_type_id' => 5, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 13, 'category_type_id' => 5, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 14, 'category_type_id' => 5, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTranslation::insert([
            ['id' => 23,     'category_id' => 12, 'language_id' => 1, 'name' => 'Restaurant',       'slug' => 'restaurant',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 24,     'category_id' => 12, 'language_id' => 2, 'name' => 'مطعم',             'slug' => 'مطعم',               'created_at' => now(), 'updated_at' => now()],
            ['id' => 25,     'category_id' => 13, 'language_id' => 1, 'name' => 'Bakery',           'slug' => 'bakery',              'created_at' => now(), 'updated_at' => now()],
            ['id' => 26,     'category_id' => 13, 'language_id' => 2, 'name' => 'مخبز',             'slug' => 'مخبز',               'created_at' => now(), 'updated_at' => now()],
            ['id' => 27,     'category_id' => 14, 'language_id' => 1, 'name' => 'Supermarket',      'slug' => 'Supermarket',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 28,     'category_id' => 14, 'language_id' => 2, 'name' => 'سوبرماركت',        'slug' => 'سوبرماركت',         'created_at' => now(), 'updated_at' => now()],
        ]);

        /**
         * Meals Categories
         */
        Category::insert([
            ['id' => 15, 'category_type_id' => 6, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 16, 'category_type_id' => 6, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 17, 'category_type_id' => 6, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 18, 'category_type_id' => 6, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
            ['id' => 19, 'category_type_id' => 6, 'is_active_in_mobile' => 1, 'is_active_in_website' => 1, 'created_at' => now(), 'created_by' => 1, 'updated_at' => now(), 'updated_by' => 1],
        ]);

        CategoryTranslation::insert([
            ['id' => 29,     'category_id' => 15, 'language_id' => 1, 'name' => 'Breakfast',    'slug' => 'breakfast',         'created_at' => now(), 'updated_at' => now()],
            ['id' => 30,     'category_id' => 15, 'language_id' => 2, 'name' => 'افطار',        'slug' => 'افطار',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 31,     'category_id' => 16, 'language_id' => 1, 'name' => 'Lunch',        'slug' => 'lunch',             'created_at' => now(), 'updated_at' => now()],
            ['id' => 32,     'category_id' => 16, 'language_id' => 2, 'name' => 'غداء',         'slug' => 'غداء',             'created_at' => now(), 'updated_at' => now()],
            ['id' => 33,     'category_id' => 17, 'language_id' => 1, 'name' => 'Dinner',       'slug' => 'dinner',           'created_at' => now(), 'updated_at' => now()],
            ['id' => 34,     'category_id' => 17, 'language_id' => 2, 'name' => 'عشاء',         'slug' => 'عشاء',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 35,     'category_id' => 18, 'language_id' => 1, 'name' => 'Suhoor',       'slug' => 'suhoor',          'created_at' => now(), 'updated_at' => now()],
            ['id' => 36,     'category_id' => 18, 'language_id' => 2, 'name' => 'سحور',         'slug' => 'سحور',            'created_at' => now(), 'updated_at' => now()],
            ['id' => 37,     'category_id' => 19, 'language_id' => 1, 'name' => 'Dinner Party', 'slug' => 'dinner-party',    'created_at' => now(), 'updated_at' => now()],
            ['id' => 38,     'category_id' => 19, 'language_id' => 2, 'name' => 'حفل عشاء',     'slug' => 'حفل-عشاء',       'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
