<?php

namespace Vanguard;

use Auth;
use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    public $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [	'name',
                            'code',
    						'avatar',
    						'required_points',
    						'poster_percent',
    						'supplier_percent',
    						'gtalents_percent',
    						'is_active',
    						'language_id'
    					];

    public function nextLevel()
    {
        $category = Category::where('required_points', '>', $this->required_points)
                                ->orderBy('required_points', 'ASC')
                                ->limit(1)
                                ->first();

        $result = $category->required_points - Auth::user()->company[0]->points->sum('sum');
        return  $result;
    }
}
