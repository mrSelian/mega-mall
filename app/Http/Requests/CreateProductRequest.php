<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required','string', 'max:25'],
            'price' => ['required','min:1','integer'],
            'quantity' => ['required','min:0','integer'],
            'mainPhotoPath' => ['required','string'],
            'fullSpecification' => ['required','string','max:800'],
        ];
    }
}
