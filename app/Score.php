<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['user_id', 'score', 'register'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
