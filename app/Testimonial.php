<?php

namespace Vanguard;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table = 'testimonials';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['recommended_user_id', 'recommended_by_user_id', 'testimony', 'testimonial_status_id', 'is_active'];

    public function testimonial_status()
    {
        return $this->hasOne(TestimonialStatus::class, 'id', 'testimonial_status_id');
    }

    public function recommended_user()
    {
        return $this->belongsTo(User::class,'recommended_user_id');
    }

    public function recommended_by_user()
    {
        return $this->belongsTo(User::class,'recommended_by_user_id');
    }
}
