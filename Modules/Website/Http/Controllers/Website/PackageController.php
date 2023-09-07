<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Package\Entities\Package;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Partners\GetAllPartnersAction;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $packages = Package::query();

        if ($request->input('country_ids') && !empty($request->input('country_ids'))) {
            $packages->whereIn('country_id', $request->input('country_ids'));
        }

        if ($request->input('period') && !empty($request->input('period'))) {
            $packages->whereIn('period', $request->input('period'));
        }

        if ($request->input('min_price') || $request->input('max_price')) {
            $packages->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
        }

        $packages = $packages->with(['country', 'translations'])->paginate(6);

        $countryCounts = Package::with('country')
            ->select('country_id', DB::raw('COUNT(*) as count'))
            ->groupBy('country_id')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->country_id => $item->count];
            })
            ->toArray();

        if ($request->ajax()) {
            return response()->json([
                'packages' => $packages,
            ]);
        }

        $partners = (new GetAllPartnersAction)->handle()->sortBy('display_order');

        return view('website::website.package.index', compact('packages', 'countryCounts', 'partners'));
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
        $package = Package::with(['translations', 'country'])->find($id);
        return view('website::website.package.show', compact('package'));
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
