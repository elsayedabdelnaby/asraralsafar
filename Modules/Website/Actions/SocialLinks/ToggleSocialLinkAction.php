<?php

namespace Modules\Website\Actions\SocialLinks;

use Modules\Website\Entities\SocialLink;
use Modules\Website\Http\Requests\SocialLinks\ToggleSocialLinkRequest;

/**
 * @purpose toggle the social link status
 */
class ToggleSocialLinkAction
{
    /**
     * @param ToggleSocialLinkRequest $request
     */
    public function handle(ToggleSocialLinkRequest $request): bool
    {
        $social_link = SocialLink::find($request->id);
        $social_link->is_active = !$social_link->is_active;
        return $social_link->save();
    }
}
