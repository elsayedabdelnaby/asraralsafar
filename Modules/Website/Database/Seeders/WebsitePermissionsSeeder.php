<?php

namespace Modules\Website\Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Modules\UsersManagement\Entities\Model;
use Modules\UsersManagement\Entities\Module;
use Modules\UsersManagement\Entities\Permission;
use Modules\UsersManagement\Services\ModelService;

class WebsitePermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create the Website module
        $module = Module::firstOrCreate(
            ['name' => 'Website'],
            ['created_at' => now(), 'updated_at' => now()]
        );

        Permission::insert([
            ['name' => "access-website", 'module_id' => $module->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()],
        ]);

        if ($module) {
            // create the website info model
            $model = Model::firstOrCreate(
                ['name' => 'Website Information', 'module_id' => $module->id],
                ['created_at' => now(), 'updated_at' => now()]
            );
            // insert the update website info
            Permission::insert([
                ['name' => 'update-' .  Str::slug($model->name), 'module_id' => $module->id, 'model_id' => $model->id, 'guard_name' => 'web', 'created_at' => now(), 'updated_at' => now()]
            ]);

            $model_service = new ModelService();

            // create the Contact Information type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Contact Information',
                $module->id,
                [
                    'listing-contact-informations',
                    'create-contact-information',
                    'update-contact-information',
                    'delete-contact-information',
                    'view-contact-information'
                ]
            );

            // create the FAQ type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'FAQ',
                $module->id,
                [
                    'listing-faqs',
                    'create-faq',
                    'update-faq',
                    'delete-faq',
                    'view-faq'
                ]
            );

            // create the Footer Section type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Footer Section',
                $module->id,
                [
                    'listing-footer-sections',
                    'create-footer-section',
                    'update-footer-section',
                    'delete-footer-section',
                    'view-footer-section'
                ]
            );

            // create the Footer link type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Footer link',
                $module->id,
                [
                    'listing-footer-links',
                    'create-footer-link',
                    'update-footer-link',
                    'delete-footer-link',
                    'view-footer-link'
                ]
            );

            // create the Social Link type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Social Link',
                $module->id,
                [
                    'listing-social-links',
                    'create-social-link',
                    'update-social-link',
                    'delete-social-link',
                    'view-social-link'
                ]
            );

            // create the Term Condition type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Term Condition',
                $module->id,
                [
                    'listing-terms-conditions',
                    'create-term-condition',
                    'update-term-condition',
                    'delete-term-condition',
                    'view-term-condition'
                ]
            );

            // create the Privacy Policy type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Privacy Policy',
                $module->id,
                [
                    'listing-privacy-policies',
                    'create-privacy-policy',
                    'update-privacy-policy',
                    'delete-privacy-policy',
                    'view-privacy-policy'
                ]
            );

            // create the Meta Page type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Meta Page',
                $module->id,
                [
                    'listing-meta-pages',
                    'create-meta-page',
                    'update-meta-page',
                    'delete-meta-page',
                    'view-meta-page'
                ]
            );

            // create the Blog type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Blog',
                $module->id,
                [
                    'listing-blogs',
                    'create-blog',
                    'update-blog',
                    'delete-blog',
                    'view-blog'
                ]
            );

            // create the Main Slider type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Main Slider',
                $module->id,
                [
                    'listing-main-sliders',
                    'create-main-slider',
                    'update-main-slider',
                    'delete-main-slider',
                    'view-main-slider'
                ]
            );

            // create the Term Condition type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'About Us',
                $module->id,
                [
                    'listing-about-us',
                    'create-about-us',
                    'update-about-us',
                    'delete-about-us',
                    'view-about-us'
                ]
            );


            // create the Testimonail type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Testimonail',
                $module->id,
                [
                    'listing-testimonails',
                    'create-testimonail',
                    'update-testimonail',
                    'delete-testimonail',
                    'view-testimonail'
                ]
            );


            // create the Partner type model and insert basics permissions of it
            $model_service->createModelAndAssignPermissions(
                'Partner',
                $module->id,
                [
                    'listing-partners',
                    'create-partner',
                    'update-partner',
                    'delete-partner',
                    'view-partner'
                ]
            );
        }
    }
}
