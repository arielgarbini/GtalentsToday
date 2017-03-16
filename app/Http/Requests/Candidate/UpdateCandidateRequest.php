<?php

namespace Vanguard\Http\Requests\Candidate;

use Vanguard\Http\Requests\Request;

class UpdateCandidateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'        => 'required',
            'last_name'         => 'required',
            'profile'           => 'required',
            'email'             => 'required|email|unique:candidates,email,' . $this->candidate,
            'accept_terms_cond' => 'required',
        ];
    }
}
