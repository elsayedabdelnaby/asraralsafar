<?php

namespace Modules\Package\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Package\Entities\Subscription;

class SubscriptionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $subscription = Subscription::where('email', $request->email)->first();
        if (empty($subscription)) {
            Subscription::create(['email' => $request->email]);
            return redirect()->route('website.index')->with('message', 'subscriped successfully');
        }

        return redirect()->route('website.index')->with('message', 'you have subscriped before');
    }
}
