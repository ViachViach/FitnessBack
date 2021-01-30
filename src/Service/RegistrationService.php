<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Registration;
use App\Entity\User;
use App\Enum\RolesEnum;
use App\Repository\UserRepository;
use CustomValidationBundle\Service\ValidationServiceInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationService
{
    private UserPasswordEncoderInterface $passwordEncoder;

    private UserRepository $userRepository;

    private ValidationServiceInterface $validationService;

    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        ValidationServiceInterface $validationService
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->validationService = $validationService;
    }

    public function registrationUser(Registration $registrationDto): void
    {
        $user = new User();
        $user
            ->setEmail($registrationDto->getEmail())
            ->setRoles([RolesEnum::ROLE_USER])
        ;
        $password = $this->passwordEncoder->encodePassword($user, $registrationDto->getPassword());
        $user->setPassword($password);

        $this->validationService->validate($user);
        $this->userRepository->save($user);
    }
}
