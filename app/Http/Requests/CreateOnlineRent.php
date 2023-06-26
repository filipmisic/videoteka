<?php

namespace App\Http\Requests;

use LVR\CreditCard\CardCvc;
use LVR\CreditCard\CardNumber;
use LVR\CreditCard\CardExpirationYear;
use LVR\CreditCard\CardExpirationMonth;
use Illuminate\Foundation\Http\FormRequest;

class CreateOnlineRent extends FormRequest
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
            'card_number' => ['required', new CardNumber],
            'expiration_year' => ['required', new CardExpirationYear($this->get('expiration_month'))],
            'expiration_month' => ['required', new CardExpirationMonth($this->get('expiration_year'))],
            'cvc' => ['required', new CardCvc($this->get('card_number'))],
            'movie_id' => ['required', 'exists:movies,id'],
            'days_rented'=>['required','integer','min:1'],
        ];
    }
    public function messages()
    {
        return[
        'card_number.required' => 'Broj kartice je obavezan',
        'expirateion_year.required' => 'Godina isteka je obavezna',
        'expirateion_month.required' => 'Mjesec isteka je obavezan',
        'cvc.required' => 'CVC je obavezan',
        'days_rented.required' => 'Broj dana za posudbu je',
        'days_rented.integer' => 'Sadrzaj mora biti numericki',
        'days_rented.min'=>'Minimalan broj danja za rentanje je 1 dan'
        ];
    }
}
