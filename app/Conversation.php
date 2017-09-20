<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'vacancy_id',
        'sender_user_id',
        'destinatary_user_id'
    ];

    public function vacancy()
    {
        return $this->belongsTo(Vacancy::class);
    }
}
