<?php

namespace Modules\Operations\Actions\BookingRequests;

use Modules\Operations\Entities\BookingRequest;
use Modules\Operations\Http\Requests\BookingRequests\EditBookingRequestRequest;

class UpdateBookingRequestAction
{
    public function handle(EditBookingRequestRequest $request)
    {
        $bookingRequest = BookingRequest::find($request->get('id'));
        $bookingRequest->status = $request->get('status');
        $bookingRequest->save();
        return $bookingRequest;
    }
}
