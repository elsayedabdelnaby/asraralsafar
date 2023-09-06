<?php

namespace Modules\Website\Http\Controllers\Website;

use Illuminate\Routing\Controller;
use Illuminate\Contracts\Support\Renderable;
use Modules\Website\Actions\PrivacyPolicies\GetAllActivePrivacyPoliciesAction;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $privacy_policies = (new GetAllActivePrivacyPoliciesAction)->handle()->sortBy('display_order');
        return view('website::website.privacy_policies.index', compact('privacy_policies'));
    }
}
