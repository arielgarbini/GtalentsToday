<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    protected $table = 'preferences';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [ 'user_id', 
    						'promotional_code', 
    						'security_question1_id', 
    						'answer1', 
    						'security_question2_id', 
    						'answer2', 
    						'contact_id',
                            'reference',
    						'organization_role_id',
    						'sourcing_network_id', 
    						'receive_messages'
    					];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
