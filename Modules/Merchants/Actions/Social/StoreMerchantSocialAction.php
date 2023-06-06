<?php

namespace Modules\Merchants\Actions\Social;

use App\Traits\FileUploadTrait;
use Modules\Merchants\Entities\MerchantSocial;
use Modules\Merchants\Http\Requests\Social\StoreMerchantSocialRequest;
use Modules\Merchants\Services\SocialService;

class StoreMerchantSocialAction
{
    use FileUploadTrait;

    public function handle(StoreMerchantSocialRequest $request): MerchantSocial
    {
        return MerchantSocial::create((new SocialService())->prepareAttributes($request));
    }
}
