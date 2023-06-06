<?php

namespace Modules\Merchants\Services;

use Illuminate\Http\Request;
use App\Traits\FileUploadTrait;
use Modules\Locations\Actions\Countries\GetAllCountries;
use Modules\Settings\Actions\Categories\FilterCategoriesAction;
use Modules\Settings\Actions\Categories\FilterSubCategoriesAction;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;
use Modules\Merchants\Http\Requests\Merchants\UpdateMerchantRequest;

class MerchantService
{
    use FileUploadTrait;

    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreMerchantRequest|UpdateMerchantRequest $request
     * @return array
     */
    public function prepareAttributes(StoreMerchantRequest|UpdateMerchantRequest $request, ?int $merchant_manger_id = null): array
    {
        $merchant_info = [
            'is_active' => $request->has('merchant_is_active') ? 1 : 0,
            'order_minimum_amount' => $request->get('order_minimum_amount'),
            'minimum_delivery_charges' => $request->get('average_delivery_time'),
            'average_delivery_time' => $request->get('maximum_distance'),
            'maximum_distance' => $request->get('maximum_distance'),
            'hot_line' => $request->get('maximum_distance'),
            'has_branches' => (bool) $request->get('has_branches'),
            'working_status' => (bool) $request->get('working_status'),
            'notes' => $request->get('notes'),
            'has_deliveries' => $request->has_deliveries ? 1 : 0,
            'rush_time_status' => $request->rush_time_status ? 1 : 0,
            'rush_time_additional_fees' => $request->rush_time_additional_fees,
            'has_branches' => $request->has('has_branches') ? 1 : 0,
            'working_status' => $request->get('working_status') ? 1 : 0,
        ];

        if (!is_null($merchant_manger_id)) {
            $merchant_info['owner_id'] = $merchant_manger_id;
        }


        if ($request->file('merchant_image')) {
            $merchant_info['logo'] = $this->verifyAndUpload($request->file('merchant_image'), '', 'public', 'merchants/merchants');
        }


        return $merchant_info;
    }


    /**
     * Take the translations array from the request and return the array to insert
     * @param array $translations
     * @param int $cityId
     * @return array
     */
    public function prepareTranslationDataToInsert(array $translations, int $merchantId): array
    {
        $translation_data = [];
        foreach ($translations as $translation) {
            $translation_data[] = [
                'name' => $translation['merchant_name'],
                'language_id' => $translation['language_id'],
                'slug'=>$translation['slug'],
                'description'=>$translation['description'],
                'meta_title'=>$translation['meta_title'],
                'meta_description'=>$translation['meta_description'],
                'rush_time_message'=>$translation['rush_time_message'],
                'merchant_id' => $merchantId,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        return $translation_data;
    }

    /**
     * Take a request and return the array of all select inputs form options
     * @param Request $request
     * @return array
     */
    public function getAllSelectInputsOptions(Request $request): array
    {
        //Get all merchant types
        $request->request->set('category_type_id', 5);
        $merchantTypes = (new FilterCategoriesAction())->handle($request)->select(['categories.id', 'category_translations.name'])->get();

        //Get all product categories
        $request->request->set('category_type_id', 1);
        $request->request->set('categories', implode(",", (new FilterCategoriesAction())->handle($request)->select(['categories.id', 'category_translations.name'])->pluck('id')->toArray()));
        $productCategories = (new FilterSubCategoriesAction())->handle($request)->select(['categories.id', 'category_translations.name'])->get();

        //Get all cuisines
        $request->request->set('category_type_id', 7);
        $cuisines = (new FilterCategoriesAction())->handle($request)->select(['categories.id', 'category_translations.name'])->get();

        //Get all meals
        $request->request->set('category_type_id', 6);
        $meals = (new FilterCategoriesAction())->handle($request)->select(['categories.id', 'category_translations.name'])->get();

        //Get all countries
        $countries = (new GetAllCountries())->handle()->select([
            'countries.id',
            'country_translations.name'
        ])->get();

        return [
            'merchantTypes' => $merchantTypes,
            'productCategories' => $productCategories,
            'cuisines' => $cuisines,
            'meals' => $meals,
            'countries' => $countries,
        ];
    }
}
