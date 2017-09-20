<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contracts';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'vacancy_id', 
    						'company_id', 
    						'nda', 
    						'contrat'
    					];

    public function vacancy()
    {
        return $this->hasOne(Vacancy::class, 'id', 'vacancy_id');
    }

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }
}
