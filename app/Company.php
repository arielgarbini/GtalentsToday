<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    protected $table = 'companies';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'name',
                            'comercial_name',
    						'register_number',
    						'description',
                            'email',
                            'address_id',
    						'website',
                            'quantity_employees_id',
    						'is_active',
                            'category_id'];

    public function company_users()
    {
        return $this->hasMany(CompanyUser::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'companies_users', 'company_id', 'user_id')->withPivot('is_active', 'position', 'created_at', 'updated_at');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function points()
    {
        return $this->hasMany(Point::class, 'company_id');
    }

    public function balance()
    {
        return $this->hasOne(Balance::class, 'company_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }

    public function experience()
    {
        return $this->hasOne(Experience::class, 'company_id');
    }

    public function profile()
    {
        return $this->hasOne(Profile::class, 'company_id');
    }

    public function quantity_employees()
    {
        return $this->hasOne(QuantityEmployees::class, 'id', 'quantity_employees_id');
    }

    public function industries()
    {
        return $this->belongsToMany(ExperienceIndustry::class,'experiencies', 'company_id', 'id')->withPivot('industry_id');
    }
}
