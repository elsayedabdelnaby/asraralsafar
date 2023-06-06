<?php

namespace Modules\Website\Actions\ContactInformations;

use Modules\Website\Entities\ContactInformation;
use Modules\Website\Http\Requests\ContactInformations\UpdateContactInformationRequest;

/**
 * handle updating the contact information
 */
class UpdateContactInformationAction
{

    /**
     * @param UpdateContactInformationRequest $request
     * @param ContactInformation $contact_information
     * @return ContactInformation
     */
    public function handle(UpdateContactInformationRequest $request, ContactInformation $contact_information): ContactInformation
    {
        $contact_information->type = $request->type;
        $contact_information->value = $request->value;
        $contact_information->is_active = $request->is_active ? true : false;
        $contact_information->save();

        return $contact_information;
    }
}
