<?php

namespace Vanguard\Events\Vacancy;

class UpdatedSupplier {

    /**
     * @var Integer
     */
    protected $vacancy;
    /**
     * @var Integer
     */
    protected $supplier;
    /**
     * @var Integer
     */
    protected $status;

    public function __construct($vacancy, $supplier, $status)
    {
        $this->vacancy = $vacancy;
        $this->supplier = $supplier;
        $this->status = $status;
    }

    /**
     * @return Vacancy
     */
    public function getVacancy()
    {
        return $this->vacancy;
    }

    /**
     * @return Supplier
     */
    public function getSupplier()
    {
        return $this->supplier;
    }

    /**
     * @return Status
     */
    public function getStatus()
    {
        return strtolower($this->status);
    }

}
