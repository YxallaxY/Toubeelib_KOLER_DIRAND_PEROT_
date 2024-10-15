<?php

use toubeelib\core\dto\CredentialsDTO;

class JWTAuthnProvider implements AuthnProviderInterface
{
    private $jwtManager;
    private $pdo;

    public function __construct(JWTManager $jwtManager, PDO $pdo)
    {
        $this->jwtManager = $jwtManager;
        $this->pdo = $pdo;
    }

    public function signin(CredentialsDTO $auth) : AuthDTO
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

    public function register(CredentialsDTO $credentials, int $role) {

    }
}

