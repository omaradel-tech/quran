<?php

namespace App\Constants;

class GenderConstant extends Constant
{
    const MALE = 'male';
    const FEMALE = 'female';

    static function getList(): array
    {
        return [
            self::MALE => 'male',
            self::FEMALE => 'female',
        ];
    }

    static function values(): array
    {
        return [
            self::MALE,
            self::FEMALE
        ];
    }
}
