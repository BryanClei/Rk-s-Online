<?php

namespace App\Http\Requests\User;

use App\Rules\PhoneNumber;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "first_name" => [
                "required",
            ],
            "last_name" => [
                "required"
            ],
            "email_address" => [
                "required","unique:users,email,NULL,deleted_at"
            ],
            "password" => [
                "required", Password::min(8)->mixedCase()->numbers()
            ],
            "mobile_number" => [
                'required', 
                new PhoneNumber(request('country'))
            ],
            "birthday" => [
                "required", "date"
            ],
            "gender" => [
                "required"
            ],
            "address" => [
                "required"
            ],
            "house_apartment_no" => [
                "required"
            ],
            "city" => [
                "required"
            ],
            "province" => [
                "required"
            ],
            "country" => [
                "required"
            ],
            "postal_code" => [
                "required"
            ]
        ];
    }

    public function messages(): array {
        return [
            "first_name.required" => "First name is required.",
            "last_name.required" => "Last name is required.",
            "email_address.required" => "Email is required.",
            "email_address.unique" => "Email is already taken.",
            "password.required" => "Password is required.",
            "password.min" => "Password must be 8 characters.",
            "password.mixed" => "Password must contain at least one uppercase and one lowercase letter." ,
            "password.numbers" => "Password must have atleaset one number.",
            "mobile_number.required" => "Mobile number is required.",
            "mobile_number.regex" => "Mobile number is invalid, it must start's with +639 or 9**.",
            "birthday.required" => "Birthday is required.",
            "gender.required" => "Gender is required.",
            "address.required" => "Address is required.",
            "house_apartment_no.required" => "House/Apartment No. is required.",
            "city.required" => "City is required.",
            "province.required" => "Province is required.",
            "country.required" => "Country is required.",
            "postal_code.required" => "Postal Code is required."
        ];
    }

    public function withValidator($validator){
        $validator->after(function ($validator){
            if ($this->password !== $this->confirm_password){
                return $validator->errors()->add('password', 'Password and confirm password do not match.');
            }
        });
    }
}
