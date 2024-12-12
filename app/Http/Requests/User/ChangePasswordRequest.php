<?php

namespace App\Http\Requests\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            "current_password" => ["required"],
            "new_password" => [
                "required",
                Password::min(8)
                    ->mixedCase()
                    ->numbers(),
            ],
            "new_password_confirmation" => ["required", "string"],
        ];
    }

    public function attributes(): array
    {
        return [
            "current_password" => "Current password",
            "new_password" => "New password",
            "new_password_confirmation" => "Confirm password",
        ];
    }

    public function messages(): array
    {
        return [
            "required" => "Please enter your :attribute",
            "min" => "The :attribute must be at least 8 characters.",
            "mixed" =>
                "The :attribute must contain at least one uppercase and one lowercase letter.",
            "numbers" => "The :attribute must have at least one number.",
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
