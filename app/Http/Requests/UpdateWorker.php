<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorker extends FormRequest
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
            'password'=>['nullable'],
            'name' =>['required','string','max:255'],
            'surname' =>['required','string','max:255'],
            'store_id'=>['required','integer'],
            'status'=>['required','boolean'],
            'workerId' => ['required', 'exists:workers,id']
        ];
    }
    public function messages()
    {
        return[
        'name.required' => 'Ime radnika je obavezan',
        'name.max' => 'Ime je veci od 255 znakova',
        'surname.required' => 'Prezike radnika je obavezan',
        'surname.max' => 'Prezime je veci od 255 znakova',
        'store_id.required' => 'Trgovina je obvezna',
        'status.required' => 'Status radnika je obvezan',
        'status.boolean'=> 'Status moze biti samo Aktivan i Neaktivan'
        ];
    }
}
