<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class UserInvited extends Model
{
    protected $table = 'users_invited';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'user_invited_id', 'code', 'status', 'vacancy_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_invited_id');
    }
}
