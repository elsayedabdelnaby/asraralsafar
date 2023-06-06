<?php

namespace Modules\Sales\Enums;

enum PaymentMethods: string
{
    case cash_on_delivery = 'cash_on_delivery';
    case wallet = 'wallet';
}
