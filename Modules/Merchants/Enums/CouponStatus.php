<?php

namespace Modules\Merchants\Enums;

enum CouponStatus: string
{
    case pending = 'pending';
    case available = 'available';
    case expired = 'expired';
}
