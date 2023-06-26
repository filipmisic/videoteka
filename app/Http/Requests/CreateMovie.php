<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMovie extends FormRequest
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
            'title'=>['required','string','max:255','unique:movies,title'],
            'year'=>['required','integer'],
            'director'=>['required','string','max:255'],
            'genre'=>['required','array'],
            'genre.*' =>['in:Fantastika,SF,Akcija,Komedija,Drama,Romantika'],
            'movie'=>['required','mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi'],
            'barcode'=>['required','numeric','unique:movies,barcode'],
        ];
    }

    public function messages()
    {
        return[
        'title.unique' => 'Film s tim nazivom vec postoji',
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
        'movie.required' => 'Film je obavezan',
        'movie.mimetypes'=> 'File mora biti video ormata',
        'barcode.required' => 'barkod je obavezna',
        'barcode.numeric' => 'Sadrzaj mora biti numericki',
        'barcode.min' => 'barkod mora biti pozitivan broj veci od 0',
        'barcode.unique' => 'barkod vec postoji'
        ];
    }

}
