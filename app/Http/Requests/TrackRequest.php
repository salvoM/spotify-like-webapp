<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrackRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'artist' => 'required|string|max:255',
            'image_url' => 'required|url|max:255',
            'album_name' => 'required|string|max:255',
            'spotify_uri' => 'required|string|max:255',
        ];
    }

    
}
