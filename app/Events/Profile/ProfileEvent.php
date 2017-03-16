<?php

namespace Vanguard\Events\Profile;

use Vanguard\Profile;

abstract class ProfileEvent
{
    /**
     * @var Profile
     */
    protected $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * @return Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
