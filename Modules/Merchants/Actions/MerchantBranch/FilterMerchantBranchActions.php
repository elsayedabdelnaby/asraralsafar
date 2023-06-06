<?php

namespace Modules\Merchants\Actions\MerchantBranch;
use \Illuminate\Http\Request;
use Modules\Merchants\Entities\MerchantBranch;

class FilterMerchantBranchActions
{
    public function handle(Request $request)
    {
        $merchantBranch = MerchantBranch::MerchantId()->currentLanguageTranslation("merchant_branches", 'merchant_branches_translations', 'merchant_branch_id')
            ->join('city_translations','city_translations.city_id','merchant_branches.city_id')
            ->where('merchant_branches_translations.language_id', getCurrentLanguage()->id)
            ->where('city_translations.language_id',getCurrentLanguage()->id);

        if ($request->request->get('name')) {
            $name = $request->request->get('name');
            $merchantBranch = $merchantBranch->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        return $merchantBranch;

    }
}
