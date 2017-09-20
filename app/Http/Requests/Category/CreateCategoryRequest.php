<?php

namespace Vanguard\Http\Requests\Category;

use Vanguard\Category;
use Vanguard\Http\Requests\Request;

class CreateCategoryRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'             => 'required',
            'code'             => 'required',
            'required_points'  => 'required|numeric',
            'poster_percent'   => 'required|numeric',
            'supplier_percent' => 'required|numeric',
            'gtalents_percent' => 'required|numeric',
        ];
    }
}
