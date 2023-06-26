<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class LoyaltyCreate extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'oib' =>['required', 'integer','unique:users,oib'],
        ];
    }
    public function messages()
    {
        return[
            'name.required' => 'Ime korisnika je obavezno',
            'name.string' => 'Ime mora biti rijec',
            'name.max' => 'Ime moze biti maksimalno 255 znakova',
            'oib.required' => 'oib je obavezan',
            'oib.unique' => 'Korisnik s tim oibom vec ima racun',
        ];
    }
}
