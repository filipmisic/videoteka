<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMovie extends FormRequest
{
    public function rules()
    {
        return [
            'title'=>['required','string','max:255'],
            'year'=>['required','integer'],
            'director'=>['required','string','max:255'],
            'genre'=>['required','array'],
            'genre.*' =>['in:Fantastika,SF,Akcija,Komedija,Drama,Romantika'],
            'movieId' => ['required', 'exists:movies,id'],
            'barcode'=>['required','numeric','min:1'],
        ];
    }

    public function messages()
    {
        return[
        'title.required' => 'Naziv filma je obavezan',
        'title.string' => 'Naslov mora biti niz znakova',
        'title.max' => 'Naslov je veci od 255 znakova',
        'year.required' => 'Godina izlaska filma je obavezna',
        'year.integer' => 'Sadrzaj mora biti numericki',
        'director.required' => 'Ime redatelja je obvezno',
        'director.string' => 'Ime redatelja mora biti niz znakova',
        'director.max' => 'Ime redatelja je veci od 255 znakova',
        'genre.required' => 'zanr obavezan',
        'genre.string' => 'zanr mora biti niz znakova',
        'genre.max' => 'zanr je veci od 255 znakova',
        'genre.in' => 'zanr mora biti (Fantastika,SF,Akcija,Komedija,Drama iliRomantika)',
        'barcode.required' => 'barkod je obavezna',
        'barcode.numeric' => 'Sadrzaj mora biti numericki',
        'barcode.min' => 'barkod mora biti pozitivan broj veci od 0',
        ];
    }

}
