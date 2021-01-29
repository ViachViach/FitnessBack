<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Exception\ValidatorException;
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
     * @throws ValidatorException
     */
    private function checkConstraintValidation(ConstraintViolationListInterface $constraintViolationList): void
    {
        foreach ($constraintViolationList as $validationException) {
            if (!$validationException instanceof ConstraintViolationInterface) {
                return;
            }

            throw new ValidatorException((string) $validationException->getMessage());
        }
    }
}
