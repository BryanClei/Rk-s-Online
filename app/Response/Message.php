<?php

namespace App\Response;

class Message
{
    const CREATED_STATUS = 201;
    const UNPROCESS_STATUS = 422;
    const DATA_NOT_FOUND = 404;
    const SUCESS_STATUS = 200;
    const DENIED_STATUS = 403;

    // Success
    const REGISTERED_SUCCESS = "Account created Successfully.";
    const SAVED_RESPONSE = "Data saved successfully.";
    const LOGIN_SUCCESS = "Login successfully.";
    const LOGOUT_USER = "Logout successfully.";
    const CHANGE_PASSWORD = "Password successfully changed.";

    // Created
    const ROLE_CREATED = "Role created successfully.";
    const CATEGORY_CREATED = "Category created successfully.";

    // Display
    const DATA_DISPLAY = "Data display succesfully.";

    // No Display
    const NO_DATA_FOUND = "Data not found.";
    const NO_DATA_TO_DISPLAY = "No data to display.";

    const INVALID_CREDENTIALS = "The email or password is incorrect.";
    const INVALID_ACTION = "Invalid action.";

    // Error Process
    const INCORRECT_CURRENT_PASSWORD = "Current password is incorrect.";
    const CATEGORY_NOT_ON_RECYCLE_BIN = "Category must be temporarily deleted before permanent deletion.";

    // Update
    const CATEGORY_UPDATED = "Category updated successfully.";

    // Delete Temporary
    const CATEGORY_DELETE_TEMPORARY = "Category deleted temporarily.";

    // Restore
    const CATEGORY_RESTORE = "Category restored successfully.";

    // Delete Permanently
    const CATEGORY_DELETED = "Category deleted permanently.";
}
