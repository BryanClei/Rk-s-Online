<?php

namespace App\Response;

class Message {
    const CREATED_STATUS = 201;
    const UNPROCESS_STATUS = 422;
    const DATA_NOT_FOUND = 404;
    const SUCESS_STATUS = 200;
    const DENIED_STATUS = 403;

    const REGISTERED_SUCCESS = "Account Created Successfully.";
    const SAVED_RESPONSE = "Data saved successfully.";

    // Display
    const DATA_DISPLAY = "Data display succesfully.";
}