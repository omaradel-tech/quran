<?php

namespace App\Constants;

abstract class Constant
{
    abstract static function getList(): array;

    public static function get($key)
    {
        return static::getList()[$key] ?? '';
    }
}
