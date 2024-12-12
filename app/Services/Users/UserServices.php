<?php

namespace App\Services\Users;

use App\Models\User;
use App\Response\Message;
use App\Functions\GlobalFunctions;
use Illuminate\Support\Facades\Hash;

class UserServices
{
    public function createUser(array $data): User
    {
        return User::create([
            "first_name" => $data["first_name"],
            "middle_name" => $data["middle_name"],
            "last_name" => $data["last_name"],
            "email" => $data["email_address"],
            "password" => bcrypt($data["password"]),
            "mobile_number" => $data["mobile_number"],
            "birthday" => $data["birthday"],
            "gender" => $data["gender"],
            "address" => $data["address"],
            "house_apartment_no" => $data["house_apartment_no"],
            "city" => $data["city"],
            "province" => $data["province"],
            "country" => $data["country"],
            "role_id" => $data["role_id"],
            "user_type" => $data["user_type"],
            "postal_code" => $data["postal_code"],
        ]);
    }

    public function change_password($user, $current_password, $new_password)
    {
        if (!Hash::check($current_password, $user->password)) {
            return GlobalFunctions::unProcess(
                Message::INCORRECT_CURRENT_PASSWORD
            );
        }

        $user->update([
            "password" => Hash::make($new_password),
        ]);

        return GlobalFunctions::display(Message::CHANGE_PASSWORD);
    }
}
