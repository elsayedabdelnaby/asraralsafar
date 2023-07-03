<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Locations\Entities\Country;
use Modules\Package\Entities\Cruise;
use Modules\Package\Entities\Package;

class CruiseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $cruises = Cruise::query();

        if ($request->input('search') && !empty($request->input('search'))) {
            $cruises->where('name', 'like', '%' . $request->input('search') . '%')
                ->orWhere('description', 'like', '%' . $request->input('search') . '%');
        }

        if ($request->input('date') && !empty($request->input('date'))){
            $cruises->where('date', $request->input('date'));
        }

        if ($request->input('country_id') && !empty($request->input('country_id'))){
            $cruises->where('country_id', $request->input('country_id'));
        }


        if ($request->input('min_price') || $request->input('max_price')) {
            $cruises->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
        }

        $cruises = $cruises->with(['translations'])->paginate(5);

        if ($request->ajax()) {
            return view('website::website.cruise.partial', compact('cruises'));
        }

        return view('website::website.cruise.index', [
            'cruises' => $cruises,
            'countries' => Country::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('website::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
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
