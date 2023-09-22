<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Operations\Entities\BookingRequest;
use Modules\Website\Entities\Service;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $service = request('service');
        return redirect(route('website.services.show', $service), 302);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'name' => 'required',
                'email' => 'nullable|email',
                'phone' => 'required|',
                'service_id' => 'required',
                'from_state_id' => 'nullable|exists:states,id,deleted_at,NULL',
                'to_state_id' => 'nullable|exists:states,id,deleted_at,NULL',
                'departure_date' => 'nullable|date',
                'persons_number' => 'nullable|numeric',
            ],
            $request->all()
        );
        $service = Service::find($request->service_id);
        BookingRequest::create($data);

        return redirect()->route('website.services.show', $service->slug)->with('success', __('website.you will be contacted soon'));
    }
}
