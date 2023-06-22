<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KothaStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'images' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'phone_no' => 'required|digits:10',
            'email' => 'required|email',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'district' => 'required',
            'city' => 'required',
            'street' => 'required',
            'additionalInfo' => 'nullable',
            'bedroom' => 'required_if:additionalInfo,1',
            'kitchen' => 'required_if:additionalInfo,1',
            'livingroom' => 'required_if:additionalInfo,1',
            'toilet' => 'required_if:additionalInfo,1',
            'parking' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'phone_no.digits' => 'Must be 10 digits',
               
            // 'phone_no' => [
            //     'digits' => 'Must be 10 digits',
            //     'required' => 'required'
            // ],
            // 'district' => 'required',
            // 'city' => 'required',
            // 'street' => 'required',
        ];
    }

}
