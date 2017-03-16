<?php

namespace Vanguard\Http\Requests\Vacancy;

use Vanguard\Http\Requests\Request;
use Vanguard\Vacancy;

class CreateVacancyRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'                      => 'required|min:6',
          //  'description'               => 'required|min:15',
            'positions_number'          => 'required|numeric|integer',
          //  'scheme_work_id'            => 'required|exists:scheme_works,id',
          //  'responsabilities'          => 'required|min:10',
          //  'experience'                => 'required',
          //  'key_points'                => 'required',
          //  'minimum_salary'            => 'numeric',
          //  'maximum_salary'            => 'numeric',
          // 'career_plan'               => 'required',
            'contract_type_id'          => 'required|exists:contract_types,id',
          //  'address_type_id'           => 'required|exists:address_types,id',
          //  'address'                   => 'required',
          //  'country'                   => 'required|exists:countries,id',
          //  'state'                     => 'required|exists:states,id',
          //  'zip_code'                  => 'required|numeric',
         //   'city'                      => 'required',
            'vacancy_status_id'         => 'required|exists:vacancy_status,id',
          //  'general_condition'         => 'required',
         //   'approximate_total_billing' => 'required',
         //   'comission'                 => 'required',
         //   'warranty'                  => 'required',

            'location'                 => 'required',
            'target_companies'         => 'required',
            'off_limits_companies'     => 'required',
            'responsabilities'         => 'required', 
            'required_experience'      => 'required',
            'key_position_questions'   => 'required',
            'file_job_description'     => 'required|max:10000',
            'file_employer'            => 'required|max:10000',
            'industry'                 => 'required',
            'search_type'              => 'required', 
            'years_experience'         => 'required', 
            'especialization_id'       => 'required|numeric', 
            'warranty_employer'        => 'required', 
            'replacement_period'       => 'required',
            'group1'                   => 'required',
            'group2'                   => 'required',
            'fee'                      => 'required',
            'general_conditions'       => 'required',
            'terms'                    => 'required',

        ];
    }
}
