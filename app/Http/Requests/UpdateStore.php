<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStore extends FormRequest
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
            'name' =>['required','string','max:255'],
            'adress'=>['required','string','max:255'],
            'city'=>['required','string','max:255'],
            'storeId' => ['required', 'exists:stores,id']
        ];
    }
    public function messages()
    {
        return[
        'name.unique'=>'Trgovina s tim imenom vec postoji',
        'name.requiered'=>'Naslov je obavezan',
        'name.string'=>'Naslov mora biti niz znakova',
        'name.max'=>'Naslov je veci od 255 znakova',
        'adress.requiered'=>'Naslov je obavezan',
        'adress.string'=>'Naslov mora biti niz znakova',
        'adress.max'=>'Naslov je veci od 255 znakova', 
        'city.requiered'=>'Naslov je obavezan',
        'city.string'=>'Naslov mora biti niz znakova',
        'city.max'=>'Naslov je veci od 255 znakova',      
        ];
    }
}
