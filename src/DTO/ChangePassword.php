<?php

declare(strict_types=1);

namespace App\DTO;

use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Validator\Constraints as Assert;

final class ChangePassword
{
    #[SerializedName(serializedName: 'old_password')]
    private ?string $oldPassword = null;

    public function __construct(
        #[Assert\NotNull,
            Assert\NotBlank,
            Assert\Email]
        private string $email,
        #[Assert\NotNull,
            Assert\NotBlank]
        private string $password,
        ?string $oldPassword = null
    ) {
        $this->oldPassword = $oldPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getOldPassword(): ?string
    {
        return $this->oldPassword;
    }
}
