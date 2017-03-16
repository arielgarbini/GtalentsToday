<?php

namespace Vanguard\Http\Requests\Company;

use Vanguard\Http\Requests\Request;

class UpdateCompanyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'            => 'required',
            'comercial_name'  => 'required',
            'description'     => 'min:6',
            'register_number' => 'required',
            'website'         => 'min:6',
            'address_type_id' => 'required|exists:address_types,id',
            'address'         => 'required',
            'country'         => 'required|exists:countries,id',
            'state'           => 'required|exists:states,id',
            'zip_code'        => 'required|numeric',
            'city'            => 'required',
        ];
    }
}
