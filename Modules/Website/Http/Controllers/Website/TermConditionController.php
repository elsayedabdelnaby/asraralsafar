<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\TermsConditions\GetAllActiveTermsConditionsAction;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $terms_conditions = (new GetAllActiveTermsConditionsAction)->handle()->sortBy('display_order');
        return view('website::website.terms_conditions.index', compact('terms_conditions'));
    }
}
