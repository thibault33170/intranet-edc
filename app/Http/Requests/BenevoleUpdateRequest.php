<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BenevoleUpdateRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required',
            'dob' => 'date|date_format:Y-m-d|before:now',
            'fa' => 'required|boolean',
            'capture' => 'required|boolean',
            'feeding' => 'required|boolean',
            'member' => 'required|boolean',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required' => 'Name is required!',
            'email.required' => 'Email is required!',
            'fa.required' => 'FA is required!',
            'capture.required' => 'Capture is required!',
            'feeding.required' => 'Feeding is required!',
            'member.required' => 'Member is required!',
        ];
    }
}
