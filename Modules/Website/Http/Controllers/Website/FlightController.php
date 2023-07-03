<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Package\Entities\Flight;
use Illuminate\Contracts\Support\Renderable;
use Modules\Package\Entities\AirLines;
use Modules\Package\Entities\ArrivalStation;
use Modules\Package\Entities\TakeoffStation;

class FlightController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $flights = Flight::query();

        if ($request->input('flight_type') && !empty($request->input('flight_type'))) {
            $flights->where('type', $request->input('flight_type'));
        }

        if ($request->input('takeoff_station_id') && !empty($request->input('takeoff_station_id'))) {
            $flights->where('takeoff_station_id', $request->input('takeoff_station_id'));
        }

        if ($request->input('arrival_station_id') && !empty($request->input('arrival_station_id'))) {
            $flights->where('arrival_station_id', $request->input('arrival_station_id'));
        }

        if ($request->input('air_lines_ids') && !empty($request->input('air_lines_ids'))) {
            $flights->whereIn('air_lines_id', $request->input('air_lines_ids'));
        }

        if ($request->input('categories') && !empty($request->input('categories'))) {
            $flights->whereIn('category', $request->input('categories'));
        }

        if ($request->input('traveling_date') && $request->input('return_date')) {
            $flights->where('traveling_date', '>=', $request->input('traveling_date'))->where('return_date', '<=', $request->input('return_date'));
        }

        if ($request->input('min_price') || $request->input('max_price')) {
            $flights->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
        }

        $flights = $flights->with(['translations'])->paginate(5);

        $takeoffStations = TakeoffStation::with('translations')->get();
        $arrivalStations = ArrivalStation::with('translations')->get();

        $economicTypeCount = Flight::where('category', 'economic')->count();
        $businessMenTypeCount = Flight::where('category', 'business_men')->count();

       $airLines = AirLines::with('translations')->get();

        
        if ($request->ajax()) {
            return view('website::website.flight.partial', compact('flights'));
        }

        return view('website::website.flight.index', [
            'flights' => $flights,
            'takeoffStations' => $takeoffStations,
            'arrivalStations' => $arrivalStations,
            'economicTypeCount' => $economicTypeCount,
            'businessMenTypeCount' => $businessMenTypeCount,
            'airLines' => $airLines
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
