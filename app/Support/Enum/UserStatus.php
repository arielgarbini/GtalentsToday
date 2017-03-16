<?php

namespace Vanguard\Support\Enum;

class UserStatus
{
    const UNCONFIRMED = 'Unconfirmed';
    const UNVERIFIED = 'Unverified';
    const ACTIVE = 'Active';
    const BANNED = 'Banned';

    public static function lists()
    {
        return [
            self::ACTIVE => trans('app.'.self::ACTIVE),
            self::BANNED => trans('app.'. self::BANNED),
            self::UNCONFIRMED => trans('app.' . self::UNCONFIRMED),
            self::UNVERIFIED => trans('app.' . self::UNVERIFIED)
        ];
    }
}