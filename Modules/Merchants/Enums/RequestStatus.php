<?php

namespace Modules\Merchants\Enums;

enum RequestStatus: string
{
    case pending = 'Pending';
    case approved = 'Approved';
    case rejected = 'Rejected';
}
