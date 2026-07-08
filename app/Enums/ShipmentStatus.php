<?php

namespace App\Enums;

enum ShipmentStatus: string
{
    case PACKED = 'packed';
    case SHIPPED = 'shipped';
    case IN_TRANSIT = 'in_transit';
    case DELIVERED = 'delivered';
    case DISTRIBUTING = 'distributing';
    case COMPLETED = 'completed';
}
