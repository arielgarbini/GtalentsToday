<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'vacancy_id', 
    						'number', 
    						'name', 
    						'amount', 
    						'tax', 
    						'supplier_user_id', 
    						'poster_user_id', 
    						'status',  
    						'payment_due'
    					];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class,'vacancy_id');
    }

    public function supplier_user()
    {
        return $this->belongsTo(User::class,'supplier_user_id');
    }

    public function poster_user()
    {
        return $this->belongsTo(User::class,'poster_user_id');
    }
}
