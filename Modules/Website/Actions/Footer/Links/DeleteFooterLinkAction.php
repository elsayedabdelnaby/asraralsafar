<?php

namespace Modules\Website\Actions\Footer\Links;

use Modules\Website\Entities\FooterLink;
use Modules\Website\Http\Requests\Footer\Links\DeleteFooterLinkRequest;

/**
 * @purpose delete a footer link
 */
class DeleteFooterLinkAction
{
    /**
     * @param DeleteFooterLinkRequest $request
     * @return boolean
     */
    public function handle(DeleteFooterLinkRequest $request): bool
    {
        $footer_link = FooterLink::find($request->id);

        // delete all translations of this item
        $footer_link->translations()->delete();

        return $footer_link->delete();
    }
}
