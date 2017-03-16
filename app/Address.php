<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use SoftDeletes;

    protected $table = 'address';

    public $primaryKey = 'id';

    public $timestamps = true;

    public $dates = ['deleted_at'];

    protected $fillable = ['address_type_id', 'address', 'complement', 'state_id', 'zip_code', 'city', 'is_active'];

    public function address_type()
    {
        return $this->hasOne(AddressType::class, 'id', 'address_type_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id');
    }
}
