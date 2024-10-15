<?php

namespace toubeelib\infrastructure\repositories;

use toubeelib\core\dto\AuthDTO;
use toubeelib\core\dto\CredentialsDTO;
use toubeelib\core\repositoryInterfaces\DbUserRepositoryInterface;
use PDO;
use toubeelib\core\repositoryInterfaces\RepositoryEntityNotFoundException;

class DbUserRepository implements DbUserRepositoryInterface
{

    protected PDO $pdo;

    public function __construct($p) {
        $this->pdo = $p;
    }

    public function getUserById($id) {

        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);

        if($stmt->execute()) {

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            unset($result["password"]);

            return $result;
        }

        return null;
    }
    public function signIn(CredentialsDTO $auth) : AuthDTO
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email");

        $stmt->bindParam(':email', $auth->email);

        try {
            if ($stmt->execute()) {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && password_verify($auth->password, $user['password'])) {
                    return new AuthDTO($user['id'], $user['email'], $user['role']);
                } else {
                    throw new RepositoryEntityNotFoundException("User not found");
                }
            }
        } catch (Exception $e) {

        }
        return new AuthDTO();
    }
}