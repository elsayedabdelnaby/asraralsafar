<?php

namespace Modules\Operations\Actions\BookingRequests;

use Modules\Operations\Entities\BookingRequest;

class GetAllBookingRequestsAction
{
    public function handle()
    {
        return BookingRequest::join('service_translations', function ($query) {
            $query->on('service_translations.service_id', '=', 'booking_requests.service_id')
                ->where('language_id', getCurrentLanguage()->id);
        });
    }
}
