<?php

namespace Modules\Website\Enums;

enum ContactInformationType: string
{
    case Phone = 'phone';
    case Email = 'email';
    case ContactUs = 'contactus';
    case Careers = 'careers';
    case WhatsApp = 'whatsapp';
}
