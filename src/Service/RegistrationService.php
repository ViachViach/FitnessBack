<?php

declare(strict_types=1);

namespace App\Service;

use App\DTO\Controller\Registration;
use App\Entity\User;
use App\Enum\RolesEnum;
use App\Exception\RegistrationException;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationService
{
    private UserPasswordEncoderInterface $passwordEncoder;

    private UserRepository $userRepository;

    private ValidatorInterface $validator;

    /**
     * RegistrationService constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $userRepository
     * @param ValidatorInterface $validator
     */
    public function __construct(
        UserPasswordEncoderInterface $passwordEncoder,
        UserRepository $userRepository,
        ValidatorInterface $validator
    ) {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository = $userRepository;
        $this->validator = $validator;
    }

    /**
     * @param Registration $registrationDto
     *
     * @throws RegistrationException
     */
    public function registrationUser(Registration $registrationDto): void
    {
        $entityUser = new User();
        $entityUser->setEmail($registrationDto->getEmail());
        $entityUser->setRoles([RolesEnum::ROLE_USER]);
        $password = $this->passwordEncoder->encodePassword($entityUser, $registrationDto->getPassword());
        $entityUser->setPassword($password);
        $this->validate($entityUser);

        $this->userRepository->save($entityUser);
    }

    /**
     * @param User $user
     * @throws RegistrationException
     */
    private function validate(User $user)
    {
        $validationErrors = $this->validator->validate($user);

        foreach ($validationErrors as $validationError) {
            throw new RegistrationException((string) $validationError);
        }
    }
}
