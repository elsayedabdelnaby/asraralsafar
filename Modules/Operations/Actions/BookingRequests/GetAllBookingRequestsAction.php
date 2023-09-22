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
        })->leftJoin('city_translations AS from_cities', function ($query) {
            $query->on('from_cities.city_id', '=', 'booking_requests.from_city_id')
                ->where('from_cities.language_id', getCurrentLanguage()->id);
        })->leftJoin('city_translations AS to_cities', function ($query) {
            $query->on('to_cities.city_id', '=', 'booking_requests.to_city_id')
                ->where('to_cities.language_id', getCurrentLanguage()->id);
        });
    }
}
