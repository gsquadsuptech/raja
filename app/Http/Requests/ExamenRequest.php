<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExamenRequest extends FormRequest
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
        $examen = $this->route('examen');
        $rules = [
            'examen_modele_id' => 'required' ,
            'document'=> 'nullable|max:255' ,
            'consultation_id'=> 'nullable' ,
            'commentaires'=> 'nullable' ,
            'conclusions'=> 'nullable' ,
        ];
        if($examen) {
            foreach($examen->examen_modele->examen_inputs as $examinput) {
                $rules[$examinput->id] = 'nullable|numeric';
            }
            if(isset($examinput) && isset($examinput->id)){
                $rules[$examinput->id+1] = 'nullable|numeric';
            }
        }
        return $rules;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'examen_modele_id' => 'modèle d\'examen' ,
            'document'=> 'document' ,
            'consultation_id'=> 'consultation' ,
        ];
    }
}
