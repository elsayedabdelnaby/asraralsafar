<?php

namespace Modules\Website\Actions\ContactInformations;

use Modules\Website\Entities\ContactInformation;
use Modules\Website\Http\Requests\ContactInformations\StoreContactInformationRequest;

/**
 * handle creating a new contact information
 */
class StoreContactInformationAction
{

    /**
     * @param StoreContactInformationRequest $request
     * @return ContactInformation
     */
    public function handle(StoreContactInformationRequest $request): ContactInformation
    {
        $contact_information = new ContactInformation();
        $contact_information->type = $request->type;
        $contact_information->value = $request->value;
        $contact_information->is_active = $request->is_active ? true : false;
        $contact_information->save();

        return $contact_information;
    }
}
