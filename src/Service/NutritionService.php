<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\UserNotFoundException;

class NutritionService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
}
