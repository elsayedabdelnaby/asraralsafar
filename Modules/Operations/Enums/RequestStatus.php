<?php

namespace Modules\Operations\Enums;

enum RequestStatus: string
{
    case New           = 'new';
    case Processing    = 'processing';
    case Done          = 'done';
    case Cancelled     = 'cancelled';
}
