<?php

namespace toubeelib\core\dto;

class AuthDTO extends DTO
{
    protected string $accessToken;
    protected string $refreshToken;
    protected string $userId;

    public function __construct(string $accessToken, string $refreshToken, string $userId) {
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
        $this->userId = $userId;
    }
}
