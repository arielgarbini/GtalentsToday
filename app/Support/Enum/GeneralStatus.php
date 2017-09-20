<?php

namespace Vanguard\Support\Enum;

class GeneralStatus
{
    const UNCONFIRMED = 'Unconfirmed';
    const ACTIVE = 'Active';
    const BANNED = 'Banned';
    const REJECTED = 'Rejected';

    public static function lists()
    {
        return [
            self::UNCONFIRMED => trans('app.' . self::UNCONFIRMED),
            self::ACTIVE => trans('app.'.self::ACTIVE),
            self::BANNED => trans('app.'. self::BANNED),
            self::REJECTED => trans('app.' . self::REJECTED)
        ];
    }
}