<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Website\Entities\Blog;
use Modules\Website\Entities\MetaPage;
use Modules\Website\Entities\Statistic;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\Partners\GetAllActivePartnersAction;
use Modules\Website\Actions\Testimonails\GetAllActiveTestimonailsAction;

class IndexPageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $languageId = getCurrentLanguage()->id;

        $metaPage = MetaPage::whereHas('translations', function ($query) use ($languageId) {
            $query->where('language_id', $languageId);
        })->where('page', 'home')->get();

        return view('website::website.index_page.index', [
            'statistics' => Statistic::with('translations')->get(),
            'blogs' => Blog::with('translations')->latest()->take(3)->get(),
            // 'testimonails' => (new GetAllActiveTestimonailsAction)->handle()->orderBy('display_order')->get(),
            'partners' => (new GetAllActivePartnersAction)->handle()->orderBy('display_order')->get(),
            'metaPage' => $metaPage
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
