<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use SoftDeletes;

    protected $table = 'candidates';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = [ 'supplier_user_id', 
    						'first_name', 
    						'last_name', 
    						'email',
                            'file',
                            'company',
                            'company_id'
    						];

    public function user()
    {
        return $this->belongsTo(User::class,'supplier_user_id');
    }

    public function pisition()
    {
        return $this->belongsTo(ActualPosition::class);
    }

    public function vacancy()
    {
        return $this->hasMany(VacancyCandidate::class);
    }
}
