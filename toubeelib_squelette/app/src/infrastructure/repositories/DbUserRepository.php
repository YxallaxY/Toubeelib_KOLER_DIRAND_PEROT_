<?php

namespace toubeelib\infrastructure\repositories;

use toubeelib\core\dto\UserDTO;
use toubeelib\core\repositoryInterfaces\DbUserRepositoryInterface;
use PDO;

class DbUserRepository implements DbUserRepositoryInterface
{

    protected PDO $pdo;

    public function __construct($p) {
        $this->pdo = $p;
    }

    public function getUserById($id) : UserDTO {

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE uuid = :username");

        $stmt->bindParam(':username', $id, PDO::PARAM_STR);

        if($stmt->execute()) {

            $result = $stmt->fetch();

            return new UserDTO($result);
        }

        return new UserDTO();
    }
}