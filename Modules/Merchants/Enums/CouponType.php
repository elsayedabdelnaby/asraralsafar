<?php

namespace Modules\Merchants\Enums;

enum CouponType: string
{
    case shipping = 'shipping';
    case order = 'order';
}
