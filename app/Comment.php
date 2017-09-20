<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $table = 'comments';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [	'user_id', 
    						'vacancy_id', 
    						'comment'
    					];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function vacancy_candidate()
    {
        return $this->belongsTo(VacancyCandidate::class,'vacancy_id');
    }
}
