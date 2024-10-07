<?php

namespace App\Http\Requests;

use App\Models\Secteur_activite_child;
use Illuminate\Foundation\Http\FormRequest;

class CreateSecteur_activite_childRequest extends FormRequest
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
