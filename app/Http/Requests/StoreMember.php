<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMember extends FormRequest
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
    public function rules(): array
    {
        return [
            'voornaam' => 'required',
            'achternaam' => 'required',
            'geslacht' => 'required',
            'geboortedatum' => 'required',
            'huisnummer' => 'required',
            'postcode' => 'required',
            'email' => 'required',
            'captcha' => 'required',
            'captchaimagestring' => 'required',
        ];
    }

}
