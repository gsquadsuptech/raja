<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CanalProspectRequest extends FormRequest
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
        $id = $this->route('canal_prospect') ? $this->route('canal_prospect')->id : 0;
        return [
            'canal_prospect' => 'required|max:100|unique:canal_prospects,canal_prospect,'. $id,
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
            'canal_prospect' => 'canal de prospection',
        ];
    }
}
