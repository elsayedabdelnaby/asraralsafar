<?php

namespace Modules\Website\Actions\Partners;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Partner;
use Modules\Website\Http\Requests\Partners\UpdatePartnerRequest;

/**
 * handle creating a new partner
 */
class UpdatePartnerAction
{
    use FileUploadTrait;

    public function handle(UpdatePartnerRequest $request, Partner $partner): Partner
    {
        $logo = $partner->logo ? $partner->logo : '';
        if ($request->hasFile('logo')) {
            $logo = $this->verifyAndUpload($request->file('logo'), $logo, 'public', 'website/partners');
        }

        $partner->display_order = $request->display_order;
        $partner->logo = $logo;
        $partner->is_active = $request->is_active ? true : false;
        $partner->save();

        return $partner;
    }
}
