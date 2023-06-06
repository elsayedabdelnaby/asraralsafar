<?php

namespace Modules\Merchants\Services;

use App\Traits\FileUploadTrait;
use Modules\Merchants\Http\Requests\Social\StoreMerchantSocialRequest;
use Modules\Merchants\Http\Requests\Social\UpdateMerchantSocialRequest;


class SocialService
{
    use FileUploadTrait;

    /**
     * Take a request and return the array of data to create|update a city
     * @param StoreMerchantSocialRequest|UpdateMerchantSocialRequest $request
     * @return array
     */
    public function prepareAttributes(StoreMerchantSocialRequest|UpdateMerchantSocialRequest $request): array
    {
        $merchant_info = [
            'merchant_id' => $request->get('merchant_id'),
            'url' => $request->get('url'),
            'display' => $request->get('display'),
            'is_active' =>$request->has('is_active') ? 1:0,
        ];


        if ($request->file('image')) {
            $merchant_info['icon'] = $this->verifyAndUpload($request->file('image'), '', 'public', 'merchants/social');
        }


        return $merchant_info;
    }
}
