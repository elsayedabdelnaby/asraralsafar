<?php

namespace Modules\Merchants\Actions\DeliveryAdjustment;

use Modules\Merchants\Entities\DeliveryAdjustments;

class FilterDeliveryAdjustmentAction
{
    public function handle()
    {
        return DeliveryAdjustments::currentLanguageTranslation("delivery_adjustments", 'delivery_adjustment_translations', 'delivery_adjustment_id');
    }
}
