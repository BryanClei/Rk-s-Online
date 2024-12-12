<?php

namespace App\Filters;

use Essa\APIToolKit\Filters\QueryFilters;

class UserFilters extends QueryFilters
{
    protected array $allowedFilters = [];

    protected array $columnSearch = [
        "first_name",
        "middle_name",
        "last_name",
        "email",
        "user_type",
        "gender",
        "address",
        "online_status",
    ];
}
