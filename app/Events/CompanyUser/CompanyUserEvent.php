<?php

namespace Vanguard\Events\CompanyUser;

use Vanguard\CompanyUser;

abstract class CompanyUserEvent
{
    /**
     * @var Company
     */
    protected $company_user;

    public function __construct(Company $company_user)
    {
        $this->company_user = $company_user;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company_user;
    }
}
