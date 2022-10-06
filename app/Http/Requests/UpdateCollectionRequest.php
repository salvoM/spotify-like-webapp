<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCollectionRequest extends FormRequest
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
        return [
            'newCollectionName' => 'required|string|max:255',
            'newImg' => 'required|url|max:255'
        ];
    }

    public function messages(){
        return [
            'newCollectionName.required' => 'Inserisci un titolo!',
            'newImg.url' => 'Inserisci un indirizzo valido!',
            'newImg.required' => 'Inserisci un indirizzo!'
        ];
    }
}
