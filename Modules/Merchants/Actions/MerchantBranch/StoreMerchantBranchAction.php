<?php

namespace Modules\Merchants\Actions\MerchantBranch;

use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Entities\MerchantBranchTranslation;
use Modules\Merchants\Http\Requests\Merchants\StoreMerchantRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchRequest;
use Modules\Merchants\Http\Requests\MerchantBranch\StoreMerchantBranchWithManagerRequest;

class StoreMerchantBranchAction
{
    /**
     * @param StoreMerchantRequest|StoreMerchantBranchRequest|StoreMerchantBranchWithManagerRequest $request
     */
    public function handle(StoreMerchantRequest|StoreMerchantBranchRequest|StoreMerchantBranchWithManagerRequest $request, $merchant_id, $merchant_branch_manager_id)
    {
        $merchant_branch = MerchantBranch::create([
            'latitude'    => $request->get('branch_latitude'),
            'longitude'   => $request->get('branch_longitude'),
            'is_active'   => $request->has('merchant_branch_is_active') ? 1 : 0,
            'merchant_id' => $merchant_id,
            'city_id'     => $request->get('city_id'),
            'manager_id'  => $merchant_branch_manager_id,
        ]);

        foreach ($request->get('merchant_branch_translations') as $merchant_branch_translation) {
            MerchantBranchTranslation::create([
                'name' => $merchant_branch_translation['merchant_branch_name'],
                'language_id' => $merchant_branch_translation['language_id'],
                'address' => $merchant_branch_translation['merchant_branch_address'],
                'merchant_branch_id' => $merchant_branch->id,
            ]);
        }
    }
}
