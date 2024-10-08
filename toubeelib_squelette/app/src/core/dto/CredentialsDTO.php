<?php

namespace toubeelib\core\dto;

class CredentialsDTO extends DTO
{
    protected string $email;
    protected string $password;

    public function __construct(string $email, string $password) {
        $this->email = $email;
        $this->password = $password;
    }

    // Getters and setters can be added if needed.
}
