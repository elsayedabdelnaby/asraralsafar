<?php

namespace Modules\Website\Actions\ContactInformations;

use Modules\Website\Entities\ContactInformation;
use Modules\Website\Http\Requests\ContactInformations\DeleteContactInformationRequest;

/**
 * handle delete a contact information
 */
class DeleteContactInformationAction
{

    /**
     * @param DeleteContactInformationRequest $request
     * @return boolean
     */
    public function handle(DeleteContactInformationRequest $request): bool
    {
        $contact_information = ContactInformation::findOrFail($request->id);
        return $contact_information->delete();
    }
}
