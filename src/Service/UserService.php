<?php

declare(strict_types=1);

namespace App\Service;

use App\Adapter\UserAdapter;
use App\DTO\Controller\Response\UserResponse;
use App\Entity\User;
use App\Exception\UserNotFoundException;
use InvalidArgumentException;
use Symfony\Component\Security\Core\Security;

class UserService
{
    public function __construct(
        private Security $security
    ) { }

    /**
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
     *
     * @throws UserNotFoundException
     */
    public function getCurrencyUserResponse(): UserResponse
    {
        $user    = $this->getCurrencyUser();
        $adapter = new UserAdapter($user);

        return $adapter->createResponse();
    }
}
