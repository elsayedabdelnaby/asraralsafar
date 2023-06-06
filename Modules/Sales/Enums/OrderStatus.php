<?php

namespace Modules\Sales\Enums;

enum OrderStatus: string
{
    case requested = 'requested';
    case approved = 'approved';
    case processing = 'processing';
    case in_delivery = 'in_delivery';
    case delivered = 'delivered';
}
