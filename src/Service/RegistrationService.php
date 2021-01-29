<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Registration;
use App\Entity\User;
use App\Enum\RolesEnum;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationService
{
    private UserPasswordEncoderInterface $passwordEncoder;

    private UserRepository $userRepository;

    private ValidationService $validationService;

    /**
     * RegistrationService constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $userRepository
     * @param ValidationService $validationService
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        ValidationService $validationService
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->validationService = $validationService;
    }

    /**
     * @param Registration $registrationDto
     */
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
