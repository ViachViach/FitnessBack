<?php

declare(strict_types=1);

namespace App\Service;

use _HumbugBox5d215ba2066e\Nette\Schema\ValidationException;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ValidationService
{
    private ValidatorInterface $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function validate(object $value): void
    {
        $errorValidator = $this->validator->validate($value);
        $this->checkConstraintValidation($errorValidator);
    }

    /**
     * @throws ValidationException
     */
    private function checkConstraintValidation(ConstraintViolationListInterface $constraintViolationList): void
    {
        foreach ($constraintViolationList as $validationException) {
            if (!$validationException instanceof ConstraintViolationInterface) {
                return;
            }

            throw new ValidationException($validationException->getMessage());
        }
    }
}
