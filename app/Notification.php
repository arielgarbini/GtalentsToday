<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['element_id',
        'user_id', 'type', 'title', 'message', 'read'
    ];
}
