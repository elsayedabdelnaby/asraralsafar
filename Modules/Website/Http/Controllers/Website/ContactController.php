<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Operations\Entities\ContactUs;
use Modules\Website\Actions\ContactInformations\GetAllContactInformationsAction;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $contactInformations = (new GetAllContactInformationsAction)->handle();
        $locationInfo = $contactInformations->filter(function ($model) {
            return $model->type == 'location';
        })->pluck('value')->toArray();

        $phoneInfo = $contactInformations->filter(function ($model) {
            return $model->type == 'phone';
        })->pluck('value')->toArray();

        $emailInfo = $contactInformations->filter(function ($model) {
            return $model->type == 'email';
        })->pluck('value')->toArray();

        return view('website::website.contact_us.index', [
            'locationInfo' => $locationInfo,
            'phoneInfo' => $phoneInfo,
            'emailInfo' => $emailInfo,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'message' => 'required',
        ]);

        ContactUs::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'title' => 'msg'
        ]);

        return redirect()->back()->with('success', 'we will contac you soon');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('website::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('website::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
