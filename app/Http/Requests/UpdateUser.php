<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
{

    public function rules()
    {
        return [

                'admin'=>['required'],
                'admin.*'=>['in:0,1'],
                'blocked'=>['required'],
                'blocked.*'=>['in:0,1'],
                'premium'=>['required'],
                'premium.*'=>['in:0,1'],
                'oib'=>['required','numeric'],
                'userId' => ['required', 'exists:users,id'],

        ];
    }
    public function messages()
    {
        return[
        'admin.required' => 'Vrsta korisnika je obavena',
        'blocked.required' => 'Status korisnika je obvezan',
        'premium.required' => 'Clanstvo korisnika je obvezno',
        'admin.in' => 'Vrsta mora biti administrator ili korisnik',
        'blocked.in' => 'Status mora biti blokiran ili aktivan',
        'premium.in' => 'Clasntvo mora biti osnovno ili premium',
        'oib.required'=>'oib je obavezan',
        'oib.numeric'=>'vrijednost oiba mora biti numericka'
        ];
    }
}
