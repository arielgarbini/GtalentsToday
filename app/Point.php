<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $table = 'points';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['user_id', 'sum', 'company_id'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
