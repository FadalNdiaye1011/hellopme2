<?php

namespace App\Http\Requests\API;

use App\Models\Secteur_activite_child;
use InfyOm\Generator\Request\APIRequest;

class CreateSecteur_activite_childAPIRequest extends APIRequest
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
        return Secteur_activite_child::$rules;
    }
}
