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
            "first_name" => ["required", "string", "max:255"],
            "middle_name" => ["nullable", "string", "max:255"],
            "last_name" => ["required", "string", "max:255"],
            "email_address" => "required|unique:users,email,NULL,deleted_at",
            "password" => [
                "required",
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
            "mobile_number" => [
                "required",
                new PhoneNumber(request("country")),
            ],
            "birthday" => "required|date",
            "gender" => "required",
            "address" => "required",
            "house_apartment_no" => "required",
            "city" => "required",
            "province" => "required",
            "country" => "required",
            "postal_code" => "required",
            "role_id" => "nullable",
            "user_type" => ["required", "in:Admin,User"],
        ];
    }

    public function attributes(): array
    {
        return [
            "first_name" => "First name",
            "last_name" => "Last name",
            "email_address" => "Email",
            "password" => "Password",
            "mobile_number" => "Mobile number",
            "birthday" => "Birthday",
            "gender" => "Gender",
            "address" => "Address",
            "house_apartment_no" => "House/Apartment No.",
            "city" => "City",
            "province" => "Province",
            "country" => "Country",
            "postal_code" => "Postal Code",
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "The :attribute is required.",
            "unique" => "The :attribute is already taken.",
            "min" => "The :attribute must be at least 8 characters.",
            "mixed" =>
                "The :attribute must contain at least one uppercase and one lowercase letter.",
            "numbers" => "The :attribute must have at least one number.",
            "date" => "The :attribute must be a valid date.",
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->password !== $this->confirm_password) {
                return $validator
                    ->errors()
                    ->add(
                        "password",
                        "Password and confirm password do not match."
                    );
            }
        });
    }
}
