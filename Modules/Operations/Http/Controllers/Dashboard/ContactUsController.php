<?php

namespace Modules\Operations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Operations\Entities\ContactUs;
use Illuminate\Contracts\Support\Renderable;
use Modules\Operations\Http\Requests\ContactUs\EditContactUsRequest;
use Modules\Operations\Actions\ContactUs\UpdateContactUsMessageAction;
use Modules\Operations\Actions\ContactUs\GetAllContactUsMessagesAction;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $messages = (new GetAllContactUsMessagesAction)->handle();
            $messages = $messages->select([
                'id',
                'name',
                'email',
                'phone',
                'title',
                'status',
                'message',
                'answer',
                'created_at',
                'updated_at',
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($messages);
            return [
                'data' => $messages,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('operations::contact_us.indexing.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditContactUsRequest $request
     * @return Renderable
     */
    public function edit(EditContactUsRequest $request)
    {
        return view('operations::contact_us.editing.form')
            ->with([
                'method'     => 'PUT',
                'action'     => route('dashboard.operations.contact-us.update', ['id' => $request->id]),
                'message'    => ContactUs::find($request->get("id")),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditContactUsRequest $request
     * @param UpdateContactUsMessageAction $action
     */
    public function update(EditContactUsRequest $request, UpdateContactUsMessageAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.operations.contact-us.index'))->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return response()->json([
                'status'  => 'error',
                'message' => $e->getMessage(),
            ]);
        }
    }
}
