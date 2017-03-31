<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class VacancyViewed extends Model
{
    const UPDATED_AT = null;

    protected $table = 'vacancy_viewed';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['vacancy_id', 'user_id'];

    public function vacancy()
    {
        return $this->BelongsTo(Vacancy::class, 'vacancy_id');
    }

    public function user()
    {
        return $this->BelongsTo(User::class, 'user_id');
    }
}
