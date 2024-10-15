<?php

namespace toubeelib\core\dto;

class AuthDTO extends DTO
{
    protected string $accessToken;
    protected string $refreshToken;
    protected string $id;
    protected string $email;
    protected int $role;

    public function __construct(string $accessToken, string $refreshToken, string $id, string $email, int $role) {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->id = $id;
        $this->email = $email;
        $this->role = $role;
    }
}
