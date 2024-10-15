<?php

class JWTManager
{
    public function createAccessToken(array $payload): string
    {
        return "";
    }

    public function createRefreshToken(array $payload): string
    {
        return "";
    }

    public function decodeToken(string $token): array
    {
        return [];
    }
}
