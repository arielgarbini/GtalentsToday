<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $table = 'messages';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

   // public $dates = ['deleted_by_destinatary'];

    protected $fillable = [	'sender_user_id', 
    						'destinatary_user_id',    
                            'candidate_id',
    						'subject', 
    						'message', 
    						'status',
                            'deleted_by_sender',
                            'deleted_by_destinatary'
    						];

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_user_id');
    }

    public function destinatary()
    {
        return $this->belongsTo(User::class,'destinatary_user_id');
    }

    public function candidate(){
        return $this->belongsTo(Candidate::class,'candidate_id');        
    }
}
