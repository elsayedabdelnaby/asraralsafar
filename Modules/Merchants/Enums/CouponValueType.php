<?php

namespace Modules\Merchants\Enums;

enum CouponValueType: string
{
    case fixed = 'fixed';
    case percentage = 'percentage';
}
