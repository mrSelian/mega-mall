<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellerInfoRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','string','max:30'],
            'phone' => [ 'max:20'],
            'email' => ['required','string', 'max:25'],
            'info' => ['max:700'],
            'main_photo' => [ 'max:100'],
            'additional_contact' =>[ 'max:50'],
            'delivery_terms' => ['required','string', 'max:300']
        ];
    }
}
