<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuartierRequest extends FormRequest
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
        $quartier = $this->route('quartier');
        $id = $quartier ? $quartier->id : 0;
        $ville_id = $quartier ? $quartier->ville_id : null;
        return [
            'nom_quartier' => 'required|max:100|unique:quartiers,nom_quartier,'. $id . ',id,ville_id,'. $ville_id,
            'ville_id' => 'required',
        ];
    }



    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'nom_quartier' => 'quartier',
            'ville_id' => 'ville',
        ];
    }
}
