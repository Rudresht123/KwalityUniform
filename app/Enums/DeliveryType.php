<?php

namespace App\Enums;

enum DeliveryType: string
{
    case SCHOOL_DELIVERY = 'school';
    case HOME_DELIVERY = 'home';
    case MIXED = 'mixed';
}
