<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Request\Registration;
use App\Entity\User;
use App\Enum\RolesEnum;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use ViachViach\CustomValidationBundle\Service\ValidationServiceInterface;

class RegistrationService
{
    public function __construct(
        private UserPasswordEncoderInterface $passwordEncoder,
        private UserRepository $userRepository,
        private ValidationServiceInterface $validationService
    ) { }

    public function registrationUser(Registration $registrationRequest): void
    {
        $user = new User();
        $user
            ->setEmail($registrationRequest->getEmail())
            ->setRoles([RolesEnum::ROLE_USER]);
        $password = $this->passwordEncoder->encodePassword($user, $registrationRequest->getPassword());
        $user->setPassword($password);

        $this->validationService->validate($user);
        $this->userRepository->save($user);
    }
}
