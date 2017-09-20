<?php

namespace Vanguard\Events\Company;

use Vanguard\Company;

abstract class CompanyEvent
{
    /**
     * @var Company
     */
    protected $company;

    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * @return Company
     */
    public function getCompany()
    {
        return $this->company;
    }
}
