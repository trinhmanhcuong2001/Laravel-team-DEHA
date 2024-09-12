<?php
namespace App\Enums;

enum ProductStatusEnums: int
{
    case ON_SALE = 1;
    case STOP_SELLING = 0;

    public static function getArrayStatus()
    {
        return [
            self::ON_SALE->value => 'On Sale',
            self::STOP_SELLING->value => 'Stop Sale',
        ];
    }

    public static function getNameStatus($key)
    {
        return self::getArrayStatus()[$key];
    }
}
