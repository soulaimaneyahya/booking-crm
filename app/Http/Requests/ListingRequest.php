<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRequest extends FormRequest
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
            'beds' => ['required','integer','min:1','max:20'],
            'baths' => ['required','integer','min:1','max:20'],
            'area' => ['required','integer','min:15','max:1500'],
            'city' => ['string', 'required'],
            'code' => ['string', 'required'],
            'street' => ['string', 'required'],
            'street_nr' => ['required', 'integer', 'min:1', 'max:1000'],
            'price' => ['required', 'numeric', 'between:10000,1000000'],
        ];
    }
}
