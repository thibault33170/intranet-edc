<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaptureUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'city' => 'required',
            'address' => 'required',
            'date' => 'required|date|date_format:Y-m-d|after:now',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'city.required' => 'City is required!',
            'address.required' => 'Address is required!',
            'date.required' => 'date is required!',
        ];
    }
}
