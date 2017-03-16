<?php

namespace Vanguard\Http\Requests\News;

use Vanguard\Http\Requests\Request;

class CreateNewsRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'       => 'required',
            'description' => 'required',
            'section'     => 'required',
        ];
    }
}
