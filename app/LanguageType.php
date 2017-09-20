<?php
namespace Vanguard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LanguageType extends Model
{
    protected $table = 'languages_types';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = ['name', 'code'];
}
