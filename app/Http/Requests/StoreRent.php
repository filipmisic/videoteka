<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRent extends FormRequest
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
                'movies.*' => ['required'],
                'movies.*.id'=>['required','integer'],
                'movies.*.user_id'=>['required','numeric'],
                'movies.*.returnal'=>['required','boolean'],
            ];
        }
        public function messages()
        {
            return[
                'movies.*.required' => 'Filmovi su obavezni',
                'movies.*.id.required'=> 'Film je obavezan',
                'movies.*.user_id.required'=>'Korisnik je obavezan',
                'movies.*.returnal.required'=>'Povrat je obavezan',
                'movies.*.id.integer'=> 'Id filma mora biti brojcana vrijednost',
                'movies.*.user_id.numeric'=>'Id korisnika mora biti brojcana vrijednost',
                'movies.*.returnal.boolean'=>'Povrat mora biti istinit ili lazan'
            ];
        }
    }
