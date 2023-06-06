<?php

namespace Modules\Merchants\Actions\Merchant;

use Modules\Merchants\Entities\Merchant;
use Modules\Merchants\Services\MerchantService;
use Modules\Merchants\Entities\MerchantTranslation;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;
use Modules\UsersManagement\Actions\Users\StoreMerchantMangerAction;
use Modules\Merchants\Actions\MerchantBranch\StoreMerchantBranchAction;
use Modules\Merchants\Actions\MerchantCategory\StoreMerchantMealsAction;
use Modules\Merchants\Actions\MerchantCategory\StoreMerchantTypesAction;
use Modules\UsersManagement\Actions\Users\StoreMerchantBranchMangerAction;
use Modules\Merchants\Actions\MerchantCategory\StoreMerchantCuisinesAction;
use Modules\Merchants\Actions\MerchantCategory\StoreMerchantCategoryItemsAction;

class StoreMerchantAction
{
    public function handle(StoreMerchantRequest $request)
    {
        //Create Merchant Manger
        $merchant_manger = (new StoreMerchantMangerAction())->handle($request);

        //Create Merchant Info
        $merchantService = new  MerchantService();
        $merchant = Merchant::create($merchantService->prepareAttributes($request, $merchant_manger->id));
        MerchantTranslation::insert($merchantService->prepareTranslationDataToInsert($request->get('merchant_translations'), $merchant->id));

        //        //Create Merchant types
        (new StoreMerchantTypesAction())->handle($request, $merchant->id);

        //        //Create Merchant Meals
        (new StoreMerchantMealsAction())->handle($request, $merchant->id);

        //        //Create Merchant Cuisines
        (new StoreMerchantCuisinesAction())->handle($request, $merchant->id);

        //        //Create Merchant Items
        (new StoreMerchantCategoryItemsAction())->handle($request, $merchant->id);

        //Create Merchant Main Branch Manager
        $merchantBranchManager = (new StoreMerchantBranchMangerAction())->handle($request, $merchant_manger->id);

        //Create Merchant Main Branch
        (new StoreMerchantBranchAction())->handle($request, $merchant->id, $merchantBranchManager->id);

        return $merchant;
    }
}
