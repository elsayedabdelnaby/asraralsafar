<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Services\GetAllServicesAction;

class ServiceController extends Controller
{

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($slug)
    {
        $service = (new GetAllServicesAction)->handle()->where('slug', $slug)->first();
        return view('website::website.services.show', compact('service'));
    }
}
