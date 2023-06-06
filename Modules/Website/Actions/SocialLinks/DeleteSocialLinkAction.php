<?php

namespace Modules\Website\Actions\SocialLinks;

use App\Services\DeleteFile;
use App\Traits\FileUploadTrait;
use Modules\Website\Entities\SocialLink;
use Modules\Website\Http\Requests\SocialLinks\DeleteSocialLinkRequest;

/**
 * handle delete a social link
 */
class DeleteSocialLinkAction
{
    use FileUploadTrait;

    /**
     * @param DeleteSocialLinkRequest $request
     * @return boolean
     */
    public function handle(DeleteSocialLinkRequest $request): bool
    {
        $social_link = SocialLink::findOrFail($request->id);
        DeleteFile::delete($social_link->icon, 'website/social_links', 'public');
        return $social_link->delete();
    }
}
