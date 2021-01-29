<?php

declare(strict_types=1);

namespace App\Adapter;

use App\DTO\Controller\UserResponse;
use App\Entity\User;
use App\Enum\RolesEnum;

class UserAdapter
{
    private User $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return UserResponse
     */
    public function createResponse(): UserResponse
    {
        $user = new UserResponse();
        $roles = $this->getRole($this->user->getRoles());
        $user
            ->setEmail($user->getEmail())
            ->setRole($roles)
        ;

        return $user;
    }

    /**
     * @param string[] $roles
     *
     * @return string
     */
    private function getRole(array $roles): string
    {
        if (in_array(RolesEnum::ROLE_USER, $roles)) {
            return 'user';
        }

        return 'admin';
    }
}
