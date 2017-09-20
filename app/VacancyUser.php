<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class VacancyUser extends Model
{
    protected $table = 'vacancy_users';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'vacancy_id', 
    						'supplier_user_id', 
    						'status',
    						'is_active',
    						'comment'
        					];

    public function vacancy()
    {
        return $this->BelongsTo(Vacancy::class, 'vacancy_id');
    }

    public function supplier()
    {
        return $this->BelongsTo(User::class, 'supplier_user_id');
    }
}
