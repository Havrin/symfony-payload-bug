<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Validator\Constraints as Assert;

final readonly class User
{
    public function __construct(
        #[Assert\NotNull,
            Assert\NotBlank,
            Assert\Email]
        private string $email,
        #[Assert\NotNull,
            Assert\NotBlank]
        private string $password,
    ) {
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
