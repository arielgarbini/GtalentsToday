<?php

namespace Vanguard\Http\Requests\User;

use Vanguard\Http\Requests\Request;
use Vanguard\User;

class UpdateUserLoginDetailsRequest extends UpdateLoginDetailsRequest
{
    /**
     * Get authenticated user.
     *
     * @return mixed
     */
    protected function getUserForUpdate()
    {
        return \Auth::user();
    }
}
