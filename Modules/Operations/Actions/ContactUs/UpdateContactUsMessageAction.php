<?php

namespace Modules\Operations\Actions\ContactUs;

use Modules\Operations\Entities\ContactUs;
use Modules\Operations\Http\Requests\ContactUs\EditContactUsRequest;

class UpdateContactUsMessageAction
{
    public function handle(EditContactUsRequest $request)
    {
        $message = ContactUs::find($request->get('id'));
        $message->answer = $request->get('answer');
        $message->who_reply_id = $message->answer ? Auth()->user()->id : null;
        $message->save();
        return $message;
    }
}
