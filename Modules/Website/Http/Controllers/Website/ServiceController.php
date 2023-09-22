<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Locations\Actions\City\FilterCitiesAction;
use Modules\Website\Actions\Services\GetAllServicesAction;

class ServiceController extends Controller
{

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Request $request, $slug)
    {
        $cities = (new FilterCitiesAction)->handle($request)->select(['cities.id', 'city_translations.name'])->where('cities.is_active', 1)->get();
        $service = (new GetAllServicesAction)->handle()->where('slug', $slug)->first();
        return view('website::website.services.show', compact('service', 'cities'));
    }
}
