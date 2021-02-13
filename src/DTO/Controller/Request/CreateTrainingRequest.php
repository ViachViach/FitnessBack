<?php

declare(strict_types=1);

namespace App\DTO\Controller\Request;

final class CreateTrainingRequest
{
    private string $name;
    private string $description;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): CreateTrainingRequest
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CreateTrainingRequest
    {
        $this->description = $description;
        return $this;
    }
}
