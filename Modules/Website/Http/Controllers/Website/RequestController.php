<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\BookingRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('website::website.request.index');
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
                'first_name' => 'required',
                'last_name' => 'required',
                'title' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'sex' => 'required',
                'dob' => 'required',
                'service' => 'required',
                'service_date' => 'required',
                'service_details' => 'required'
            ],
            $request->all()
        );

        $data['name'] = $request->title . $request->first_name . $request->last_name;

        BookingRequest::create($data);

        return redirect()->route('request.index')->with('success', __('you will be contacted soon'));
    }
}
