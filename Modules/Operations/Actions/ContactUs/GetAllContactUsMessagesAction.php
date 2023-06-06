<?php

namespace Modules\Operations\Actions\ContactUs;

use Modules\Operations\Entities\ContactUs;

class GetAllContactUsMessagesAction
{
    public function handle()
    {
        $messages = ContactUs::query();
        return $messages;
    }
}
