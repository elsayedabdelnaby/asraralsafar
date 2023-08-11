<?php

namespace Modules\Website\Actions\Partners;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Partner;
use Modules\Website\Http\Requests\Partners\StorePartnerRequest;

/**
 * handle creating a new partner
 */
class StorePartnerAction
{
    use FileUploadTrait;

    /**
     * @param StorePartnerRequest $request
     * @return Partner
     */
    public function handle(StorePartnerRequest $request): Partner
    {
        $logo = '';
        if ($request->hasFile('logo')) {
            $logo = $this->verifyAndUpload($request->file('logo'), $logo, 'public', 'website/partners');
        }

        $partner = new Partner();
        $partner->display_order = $request->display_order;
        $partner->logo = $logo;
        $partner->is_active = $request->is_active ? true : false;
        $partner->save();

        return $partner;
    }
}
