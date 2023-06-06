<?php

namespace Modules\Website\Actions\Footer\Links;

use Modules\Website\Entities\FooterLink;
use Modules\Website\Http\Requests\Footer\Links\ToggleFooterLinkRequest;

/**
 * @purpose toggle the footer link status
 */
class ToggleFooterLinkAction
{
    /**
     * @param ToggleFooterLinkRequest $request
     */
    public function handle(ToggleFooterLinkRequest $request): bool
    {
        $footer_link = FooterLink::find($request->id);
        $footer_link->is_active = !$footer_link->is_active;
        return $footer_link->save();
    }
}
