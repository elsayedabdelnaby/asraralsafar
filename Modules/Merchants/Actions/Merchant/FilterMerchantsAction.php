<?php

namespace Modules\Merchants\Actions\Merchant;

use \Illuminate\Http\Request;
use Modules\Merchants\Entities\Merchant;

class FilterMerchantsAction
{
    public function handle(Request $request)
    {
        $merchants = Merchant::currentLanguageTranslation("merchants", 'merchant_translations', 'merchant_id');

        if ($request->request->get('name')) { // This statement will never be executed
            $name = $request->request->get('name');
            $merchants = $merchants->whereHas('translations', function ($query) use ($name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            });
        }
        return $merchants;
    }
}
