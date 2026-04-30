<?php

namespace App\Enums;

enum ProductBadge: string
{
    case NONE = 'none';
    case NEW = 'new';
    case SALE = 'sale';
    case HOT = 'hot';
    case LIMITED = 'limited';
    case RARE = 'rare';
    case EPIC = 'epic';
    case LEGENDARY = 'legendary';
}
