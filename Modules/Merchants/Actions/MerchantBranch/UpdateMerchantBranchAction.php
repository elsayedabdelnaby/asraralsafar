<?php

namespace Modules\Merchants\Actions\MerchantBranch;

use Modules\Merchants\Entities\MerchantBranch;
use Modules\Merchants\Entities\MerchantBranchTranslation;
use Modules\Merchants\Http\Requests\MerchantBranch\UpdateMerchantBranchWithManagerRequest;

class UpdateMerchantBranchAction
{
    public function handle(UpdateMerchantBranchWithManagerRequest $request, $merchant_id, $branch_manger_id)
    {
        $merchant_branch = MerchantBranch::find($request->get('id'));
        $merchant_branch->update([
            'latitude'    => $request->get('branch_latitude'),
            'longitude'   => $request->get('branch_longitude'),
            'is_active'   => $request->has('merchant_branch_is_active') ? 1 : 0,
            'merchant_id' => $merchant_id,
            'city_id'     => $request->get('city_id'),
            'manager_id'  => $branch_manger_id,
        ]);

        $languageIds = [];
        foreach ($request->get('mercahant_branch_translations') as $merchant_branch_translation) {
            $languageIds[] = $merchant_branch_translation['language_id'];
            MerchantBranchTranslation::updateOrCreate(
                [
                    'language_id' => $merchant_branch_translation['language_id'],
                    'merchant_branch_id' => $request->get('id'),
                ],
                [
                    'name' => $merchant_branch_translation['merchant_branch_name'],
                    'address' => $merchant_branch_translation['merchant_branch_address'],
                ]
            );
        }

        $this->deleteDonotExistTranslationsInNew($merchant_branch->translations->pluck('language_id')->toArray(), $languageIds, $request->get('id'));
    }

    private function deleteDonotExistTranslationsInNew(array $currentLanguagesIds, array $newLanguagesIds, int $branchId): bool
    {
        //Delete Not Exist Country Translations
        $deletedLanguages = array_diff($currentLanguagesIds, $newLanguagesIds);
        return MerchantBranchTranslation::whereIn('language_id', $deletedLanguages)->where('merchant_branch_id', $branchId)->delete();
    }
}
