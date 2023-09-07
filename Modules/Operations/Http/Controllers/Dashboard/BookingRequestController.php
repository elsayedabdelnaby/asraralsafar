<?php

namespace Modules\Operations\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;
use Modules\Operations\Entities\BookingRequest;
use Modules\Operations\Actions\BookingRequests\UpdateBookingRequestAction;
use Modules\Operations\Actions\BookingRequests\GetAllBookingRequestsAction;
use Modules\Operations\Enums\RequestStatus;
use Modules\Operations\Http\Requests\BookingRequests\EditBookingRequestRequest;

class BookingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $bookingRequests = (new GetAllBookingRequestsAction)->handle();
            $bookingRequests = $bookingRequests->select([
                'booking_requests.id',
                'booking_requests.name',
                'email',
                'phone',
                'status',
                DB::raw('service_translations.name AS service_name'),
                'booking_requests.created_at',
                'booking_requests.updated_at',
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($bookingRequests);
            return [
                'data' => $bookingRequests,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('operations::booking_requests.indexing.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditBookingRequestRequest $request
     * @return Renderable
     */
    public function edit(EditBookingRequestRequest $request)
    {
        return view('operations::booking_requests.editing.form')
            ->with([
                'method'     => 'PUT',
                'action'     => route('dashboard.operations.contact-us.update', ['id' => $request->id]),
                'booking_request'    => BookingRequest::with('service.translation')->where('id', $request->get("id"))->first(),
                'status'     => RequestStatus::cases(),
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditBookingRequestRequest $request
     * @param UpdateBookingRequestAction $action
     */
    public function update(EditBookingRequestRequest $request, UpdateBookingRequestAction $action)
    {
        try {
            $action->handle($request);
            return redirect(route('dashboard.operations.booking-requests.index'))->with(
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
