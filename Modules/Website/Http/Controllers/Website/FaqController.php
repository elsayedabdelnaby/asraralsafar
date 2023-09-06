<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\FAQs\GetAllActiveFAQsAction;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $faqs = (new GetAllActiveFAQsAction)->handle()->orderBy('display_order')->get();
        return view('website::website.faq.index', compact('faqs'));
    }
}
