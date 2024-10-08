<?php

namespace toubeelib\core\auth;

use toubeelib\core\dto\CredentialsDTO;
use toubeelib\core\dto\AuthDTO;
use toubeelib\core\dto\TokenDTO;

interface AuthnProviderInterface
{
    public function register(CredentialsDTO $credentials, int $role): void;

    public function signin(CredentialsDTO $credentials): AuthDTO;

    public function refreshToken(TokenDTO $token): AuthDTO;

    public function getSignedInUser(TokenDTO $token): AuthDTO;
}
