<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateWorker extends FormRequest
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
            'number' =>['required','unique:workers,number'],   
            'password'=>['required'],
            'name' =>['required','string','max:255'],
            'surname' =>['required','string','max:255'],
            'store_id'=>['required','integer'],
        ];
    }
    public function messages()
    {
        return[
        'name.required'=>'Ime radnika je obavezan',
        'name.max'=>'Ime je veci od 255 znakova',
        'surname.required'=>'Prezike radnika je obavezan',
        'surname.max'=>'Prezime je veci od 255 znakova',
        'password.required'=>'Lozinka je obavezan',
        'number.required'=>'Sifra radnika je obavezan',
        'number.unique'=>'Sifra radnika vec postoji',
        'store_id.required'=>'Trgovina je obvezna',
        ];
    }
}
