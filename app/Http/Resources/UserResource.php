<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "first_name" => $this->first_name,
            "middle_name" => $this->middle_name,
            "last_name" => $this->last_name,
            "suffix" => $this->suffix,
            "email_address" => $this->email,
            "mobile_number" => $this->mobile_number,
            "birthday" => $this->birthday,
            "gender" => $this->gender,
            "address" => $this->address,
            "house_apartment_no" => $this->house_apartment_no,
            "city" => $this->city,
            "province" => $this->province,
            "country" => $this->country,
            "role_id" => $this->role_id,
            "user_type" => $this->user_type,
            "postal_code" => $this->postal_code,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
            "deleted_at" => $this->deleted_at
        ];
    }
}
