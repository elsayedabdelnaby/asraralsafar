<?php

namespace Modules\Website\Actions\ContactInformations;

use Modules\Website\Entities\ContactInformation;
use Modules\Website\Http\Requests\ContactInformations\ToggleContactInformationRequest;

/**
 * @purpose toggle the contact information status
 */
class ToggleContactInformationAction
{
    /**
     * @param ToggleContactInformationRequest $request
     */
    public function handle(ToggleContactInformationRequest $request): bool
    {
        $contact_information = ContactInformation::find($request->id);
        $contact_information->is_active = !$contact_information->is_active;
        return $contact_information->save();
    }
}
