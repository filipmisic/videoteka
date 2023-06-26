<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserReview extends FormRequest
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
            'title' =>['required','string','max:255'],
            'body'=>['required','string','max:10000'],
            'score'=>['required','integer','min:1','max:10'],
            'movie_id' => ['required', 'exists:movies,id'],
        ];
    }
    public function messages()
    {
        return[
        'title.requiered'=>'Naslov je obavezan',
        'title.string'=>'Naslov mora biti niz znakova',
        'title.max'=>'Naslov je veci od 255 znakova',
        'body.requiered'=>'Sadrzaj je obavezan',
        'body.string'=>'Sadrzaj mora biti niz znakova',
        'body.max'=>'Sadrzaj je veci od maksimalnog',
        'score.required'=>'Ocjena je obavezna',
        'score.integer'=>'Ocijena mora biti brojcana vrijednost',
        'score.min'=>'Minimalna ocjena je 1',
        'score.max'=>'Maksimalna cjena je 10',
        
        ];
    }

}
