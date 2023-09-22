<?php

namespace Modules\Operations\Actions\BookingRequests;

use Modules\Operations\Entities\BookingRequest;

class GetAllBookingRequestsAction
{
    public function handle()
    {
        return BookingRequest::join('service_translations', function ($query) {
            $query->on('service_translations.service_id', '=', 'booking_requests.service_id')
                ->where('service_translations.language_id', getCurrentLanguage()->id);
        })->leftJoin('state_translations AS from_states', function ($query) {
            $query->on('from_states.state_id', '=', 'booking_requests.from_state_id')
                ->where('from_states.language_id', getCurrentLanguage()->id);
        })->leftJoin('state_translations AS to_states', function ($query) {
            $query->on('to_states.state_id', '=', 'booking_requests.to_state_id')
                ->where('to_states.language_id', getCurrentLanguage()->id);
        });
    }
}
