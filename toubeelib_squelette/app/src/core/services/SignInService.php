<?php

namespace toubeelib\core\services;

use toubeelib\core\dto\UserDTO;
use toubeelib\core\repositoryInterfaces\DbUserRepositoryInterface;
use toubeelib\core\services\SignInServiceInterface;

class SignInService implements SignInServiceInterface
{
    protected DbUserRepository $userRepository;

    public function __construct(DbUserRepository $userRepository)
    {
        $this->$userRepository = $userRepository;
    }

    public function getUserById(string $id): UserDTO
    {
        $user = $this->userRepository->getUserById($id);

        return new UserDTO($user);
    }
}