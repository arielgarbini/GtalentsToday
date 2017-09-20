<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;
use Vanguard\Company;

class UpdateCompanyProfileRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'availability'                    => 'required',
            'size'                            => 'required',
            'actual_position_id'              => 'required',
            'profile_position_id'             => 'required',
            'type_of_shared_search_id'        => 'required',
            'type_of_involved_search_id'      => 'required',
            'type_of_shared_opportunity_id'   => 'required',
            'type_of_involved_opportunity_id' => 'required',
        ];
    }
}
