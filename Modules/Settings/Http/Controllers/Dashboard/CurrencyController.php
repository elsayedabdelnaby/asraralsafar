<?php

namespace Modules\Settings\Http\Controllers\Dashboard;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Settings\Entities\Currency;
use Illuminate\Contracts\Support\Renderable;
use Modules\Settings\Services\CurrencyService;
use Modules\Settings\Actions\Currencies\GetAllCurrencies;
use Modules\Settings\Actions\Currencies\StoreCurrencyAction;
use Modules\Settings\Actions\Currencies\DeleteCurrencyAction;
use Modules\Settings\Actions\Currencies\ToggleCurrencyAction;
use Modules\Settings\Actions\Currencies\UpdateCurrencyAction;
use Modules\Settings\Http\Requests\Currency\EditCurrencyRequest;
use Modules\Settings\Http\Requests\Currency\StoreCurrencyRequest;
use Modules\Settings\Http\Requests\Currency\DeleteCurrencyRequest;
use Modules\Settings\Http\Requests\Currency\ToggleCurrencyRequest;
use Modules\Settings\Http\Requests\Currency\UpdateCurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $currencies = (new GetAllCurrencies)->handle($request);
            $currencies = $currencies->select([
                'currencies.id',
                'currency_translations.name',
                'currencies.iso_code',
                'currencies.is_main',
                'currencies.symbol',
                'currencies.is_symbol_first',
                'currencies.html_entity',
                'currencies.is_active',
                DB::raw('NULL AS actions')
            ])->get();
            $total = count($currencies);
            return [
                'data' => $currencies,
                'recordsTotal' => $total,
                'recordsFiltered' => $total,
            ];
        }
        return view('settings::currencies.indexing.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('settings::currencies.creating_editing.form')
            ->with([
                'method' => 'POST',
                'action' => route('dashboard.settings.currencies.store'),
                'mainCurrencyName' => (new CurrencyService)->getMainCurrency()->currencyName,
                'isMainCurrency' => false
            ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param StoreCurrencyRequest $request
     * @param StoreCurrencyAction $action
     * @return Renderable
     */
    public function store(StoreCurrencyRequest $request, StoreCurrencyAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/currencies')->with(
                'success',
                __('dashboard.created_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/currencies')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Toggle the specified Tag.
     * @param ToggleCurrencyRequest $request
     * @param ToggleCurrencyAction $action
     * @return Renderable
     */
    public function toggle(ToggleCurrencyRequest $toggle_request, ToggleCurrencyAction $action)
    {
        try {
            $action->handle($toggle_request);
            return response()->json(
                [
                    'status'  => 'success',
                    'message' => __('settings::dashboard.the_tag_toggle_was_successfully'),
                ]
            );
        } catch (Exception $e) {
            return response()->json(
                [
                    'status'  => 'error',
                    'message' => $e->getMessage(),
                ]
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param EditCurrencyRequest $request
     * @return Renderable
     */
    public function edit(EditCurrencyRequest $request)
    {
        $mainCurrency = (new CurrencyService)->getMainCurrency();
        return view('settings::currencies.creating_editing.form')
            ->with([
                'method' => 'PUT',
                'action' => route('dashboard.settings.currencies.update', ['id' => $request->id]),
                'currency'    => Currency::find($request->id),
                'mainCurrencyName' => $mainCurrency->currencyName,
                'isMainCurrency' => $mainCurrency->id == $request->id
            ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateCurrencyRequest $request
     * @param UpdateCurrencyAction $action
     * @return Renderable
     */
    public function update(UpdateCurrencyRequest $request, UpdateCurrencyAction $action)
    {
        try {
            $action->handle($request);
            return redirect('dashboard/settings/currencies')->with(
                'success',
                __('dashboard.updated_successfully')
            );
        } catch (Exception $e) {
            return redirect('dashboard/settings/currencies')->with(
                'error',
                $e->getMessage()
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param DeleteCurrencyRequest $request
     * @param DeleteCurrencyAction $action
     * @param int $id
     * @return Renderable
     */
    public function destroy(DeleteCurrencyRequest $request, DeleteCurrencyAction $action)
    {
        return $action->handle($request);
    }
}
