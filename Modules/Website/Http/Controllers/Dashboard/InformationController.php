<?php

namespace Modules\Website\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Entities\WebsiteInformation;
use Modules\Website\Actions\Information\UpdateInformationAction;
use Modules\Website\Http\Requests\Information\UpdateInformaitonRequest;

class InformationController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     * @return Renderable
     */
    public function edit(): Renderable
    {
        return view('website::information.form')->with([
            'website_information' => WebsiteInformation::findOrFail(1),
            'method' => 'PUT',
            'action' => route('dashboard.website.information.update', ['id' => 1]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateInformaitonRequest $request, UpdateInformationAction $action)
    {
        try {
            $website_information = WebsiteInformation::findOrFail(1);
            $website_information = $action->handle($request, $website_information);
            return redirect('dashboard/website/information/1/edit')->with('success', __('dashboard.updated_successfully'));
        } catch (Exception $e) {
            return redirect('dashboard/website/information/1/edit')->with('error', $e->getMessage());
        }
    }
}
