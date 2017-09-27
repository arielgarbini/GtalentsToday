<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Balance extends Model
{
    use SoftDeletes;

    protected $table = 'balances';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = ['company_id', 'credit', 'status'];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class,'vacancy_id');
    }
}
