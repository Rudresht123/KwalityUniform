<?php

namespace App\Enums;

enum DeliveryType: string
{
    case SCHOOL_DELIVERY = 'school_delivery';
    case HOME_DELIVERY = 'home_delivery';
    case MIXED = 'mixed';
}
