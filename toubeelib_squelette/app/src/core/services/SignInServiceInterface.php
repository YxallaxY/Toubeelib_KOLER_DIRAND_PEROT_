<?php

namespace toubeelib\core\services;

use toubeelib\core\dto\RdvDTO;
use toubeelib\core\dto\UserDTO;

interface SignInServiceInterface
{

    public function getUserById(string $id): UserDTO;


}