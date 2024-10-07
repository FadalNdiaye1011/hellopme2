<?php

namespace App\Http\Requests\API;

use App\Models\SecteurActivite;
use InfyOm\Generator\Request\APIRequest;

class UpdateSecteurActiviteAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = SecteurActivite::$rules;
        
        return $rules;
    }
}
