<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;
use Vanguard\Company;

class UpdateCompanyExperienceRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cases_number_id'     => 'required',
            'experience_years_id' => 'required',
            'level_position_id'   => 'required',
        ];
    }
}
