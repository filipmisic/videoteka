<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InventoryCreate extends FormRequest
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
            'movie_id'=>['required','array'],
            'movie_id.*' =>['required'],
            'amount'=>['required','array'],
            'amount.*' =>['required'],
        ];
        
    }
    public function messages()
    {
        return[
            'movie_id.required' => 'filmovi su obavezni',
            'movie_id.*.required' => 'filmovi su obavezni',
            'amount.reqired' => 'kolicine su obavezne'  ,
            'amount.*.required' => 'kolicine su obavezne'     
        ];
    }
}
