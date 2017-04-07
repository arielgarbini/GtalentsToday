<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{
    protected $table = 'companies_users';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'company_id', 
    						'user_id',
    						'is_active',
    						'position'
        					];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
