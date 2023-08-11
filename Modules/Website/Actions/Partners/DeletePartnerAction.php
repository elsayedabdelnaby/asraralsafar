<?php

namespace Modules\Website\Actions\Partners;

use App\Services\DeleteFile;
use App\Traits\FileUploadTrait;
use Modules\Website\Entities\Partner;
use Modules\Website\Http\Requests\Partners\DeletePartnerRequest;

/**
 * handle delete a partner
 */
class DeletePartnerAction
{
    use FileUploadTrait;

    /**
     * @param DeletePartnerRequest $request
     * @return boolean
     */
    public function handle(DeletePartnerRequest $request): bool
    {
        $partner = Partner::findOrFail($request->id);
        DeleteFile::delete($partner->logo, 'website/partners', 'public');
        return $partner->delete();
    }
}
