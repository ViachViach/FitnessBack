<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\UserAdapter;
use App\DTO\Controller\UserResponse;
use App\Entity\User;
use App\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use InvalidArgumentException;

class UserService
{
    private Security $security;

    /**
     * UserService constructor.
     *
     * @param Security $security
     */
    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @return User
     *
     * @throws UserNotFoundException
     */
    public function getCurrencyUser(): User
    {
        $user = $this->security->getUser();
        if ($user === null) {
            throw new UserNotFoundException('User not found');
        }

        if (!($user instanceof User)) {
            throw new InvalidArgumentException('User must be App\Entity\User::class');
        }

        return $user;
    }

    /**
     * @return UserResponse
     *
     * @throws UserNotFoundException
     */
    public function getCurrencyUserResponse(): UserResponse
    {
        $user = $this->getCurrencyUser();
        $adapter = new UserAdapter($user);
        return $adapter->createResponse();
    }
}
