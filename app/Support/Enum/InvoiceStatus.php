<?php

namespace Vanguard\Support\Enum;

class InvoiceStatus
{
    const APPROVED = 'Approved';
    const PENDING = 'Pending';
    const REJECTED = 'Rejected';

    public static function lists()
    {
        return [
            self::APPROVED => trans('app.' . self::APPROVED),
            self::PENDING => trans('app.'.self::PENDING),
            self::REJECTED => trans('app.'. self::REJECTED)
        ];
    }
}