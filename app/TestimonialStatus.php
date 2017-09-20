<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class TestimonialStatus extends Model
{
    protected $table = 'testimonial_status';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['name'];
}
