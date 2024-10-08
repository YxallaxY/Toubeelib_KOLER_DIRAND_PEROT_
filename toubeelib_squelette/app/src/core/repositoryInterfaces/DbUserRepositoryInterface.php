<?php

namespace toubeelib\core\repositoryInterfaces;

use toubeelib\core\domain\entities\praticien\Praticien;
use toubeelib\core\domain\entities\praticien\Specialite;
use toubeelib\core\dto\UserDTO;

interface DbUserRepositoryInterface
{
    public function __construct($pdo);

    public function getUserById($id) : UserDTO;

}