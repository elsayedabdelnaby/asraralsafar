<?php

namespace Modules\Merchants\Actions\Social;

use App\Traits\FileUploadTrait;
use Modules\Merchants\Entities\MerchantSocial;
use Modules\Merchants\Http\Requests\Social\UpdateMerchantSocialRequest;
use Modules\Merchants\Services\SocialService;

class UpdateMerchantSocialAction
{
    use FileUploadTrait;

    public function handle(UpdateMerchantSocialRequest $request): void
    {
        MerchantSocial::whereId($request->get("id"))
            ->update((new SocialService())->prepareAttributes($request));
    }
}
