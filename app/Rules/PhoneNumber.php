<?php

namespace App\Rules;

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    protected $countryCode;

    public function __construct($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function passes($attribute, $value)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();

        try {
            $phoneNumber = $phoneUtil->parse($value, $this->countryCode);
            if (
                $phoneUtil->getRegionCodeForNumber($phoneNumber) !==
                $this->countryCode
            ) {
                return false;
            }
            return $phoneUtil->isValidNumber($phoneNumber);
        } catch (NumberParseException $e) {
            return false;
        }
    }

    public function message()
    {
        return "The :attribute must be a valid phone number for the selected country.";
    }
}
