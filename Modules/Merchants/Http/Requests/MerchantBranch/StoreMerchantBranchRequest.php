<?php

namespace Modules\Merchants\Http\Requests\MerchantBranch;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Merchants\Rules\UniqueMerchantBranchName;


class StoreMerchantBranchRequest extends FormRequest
{

    private $merchant_branch_id;
    public function __construct($merchant_branch_id = null)
    {
        $this->merchant_branch_id=$merchant_branch_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Start Merchant Branch
            'merchant_branch_translations'=>['required','array',new UniqueMerchantBranchName($this->merchant_branch_id)],
            'city_id'=>'required|integer|exists:cities,id,deleted_at,NULL',
            'branch_latitude'=>'required|numeric',
            'branch_longitude'=>'required|numeric',
            //End Merchant Branch
        ];
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
}
