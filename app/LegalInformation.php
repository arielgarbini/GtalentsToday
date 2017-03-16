<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class LegalInformation extends Model
{
    protected $table = 'legal_informations';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'user_id', 
    						'legal_first_name',
    						'legal_last_name',
    						'legal_company_name',
    						'company_type',
    						'principal_coin',
    						'address_id',
    						'accept_terms_cond'
    					];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function address()
    {
        return $this->hasOne(Address::class, 'id', 'address_id');
    }
}
