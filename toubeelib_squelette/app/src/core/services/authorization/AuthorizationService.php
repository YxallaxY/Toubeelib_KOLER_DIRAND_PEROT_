<?php

namespace toubeelib\core\services\praticien;

use toubeelib\core\dto\AuthDTO;
use toubeelib\core\dto\CredentialsDTO;
use toubeelib\core\repositoryInterfaces\PraticienRepositoryInterface;

class AuthorizationService
{

    private DbUserRepository $praticienRepository;

    public function __construct(PraticienRepositoryInterface $praticienRepository)
    {
        $this->praticienRepository = $praticienRepository;
    }

    public function signIn(CredentialsDTO $p): AuthDTO
    {

        return new AuthDTO($p);
    }
}