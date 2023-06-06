<?php

namespace Modules\Website\Actions\SocialLinks;

use App\Traits\FileUploadTrait;
use Modules\Website\Entities\SocialLink;
use Modules\Website\Http\Requests\SocialLinks\UpdateSocialLinkRequest;

/**
 * handle creating a new social link
 */
class UpdateSocialLinkAction
{
    use FileUploadTrait;

    public function handle(UpdateSocialLinkRequest $request, SocialLink $social_link): SocialLink
    {
        $icon = $social_link->icon ? $social_link->icon : '';
        if ($request->hasFile('icon')) {
            $icon = $this->verifyAndUpload($request->file('icon'), $icon, 'public', 'website/social_links');
        }

        $social_link->url = $request->url;
        $social_link->display_order = $request->display_order;
        $social_link->icon = $icon;
        $social_link->is_active = $request->is_active ? true : false;
        $social_link->save();

        return $social_link;
    }
}
