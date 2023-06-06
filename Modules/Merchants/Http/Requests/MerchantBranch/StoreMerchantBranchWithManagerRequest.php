<?php

namespace Modules\Merchants\Http\Requests\MerchantBranch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\UniqueMerchantBranchName;
use Modules\UsersManagement\Http\Requests\Users\StoreMerchantBranchMangerRequest;


class StoreMerchantBranchWithManagerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $store_merchant_branch_with_mangers_rules = [
            'merchant_id'          => 'required|exists:merchants,id,deleted_at,NULL',
            'select_branch_manger' => 'required|in:select_from_mangers,create_new_manager'
        ];

        //Get Rules of Merchant Branch Manager
        if ($this->request->get('select_branch_manger')) {
            $store_merchant_branch_with_mangers_rules['merchant_branch_manger_id'] = 'required|exists:users,id,deleted_at,NULL';
        }
        else {
            $store_merchant_branch_with_mangers_rules = array_merge($store_merchant_branch_with_mangers_rules, (new StoreMerchantBranchMangerRequest())->rules());
        }

        //Get Rules OF merchant Branch
        return array_merge($store_merchant_branch_with_mangers_rules, (new StoreMerchantBranchRequest())->rules());
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'merchant_id' => request('merchant_id')
        ]);
    }
}
