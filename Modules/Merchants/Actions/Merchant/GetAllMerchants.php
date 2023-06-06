<?php

namespace Modules\Merchants\Actions\Merchant;
use Modules\Merchants\Entities\Merchant;

class GetAllMerchants
{
    public function handle()
    {
        return Merchant::currentLanguageTranslation("merchants", 'merchant_translations', 'merchant_id')->select([
            'merchants.id',
            'merchant_translations.name'
        ])->get();
    }
}
