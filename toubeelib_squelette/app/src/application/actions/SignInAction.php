<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use toubeelib\application\renderer\JsonRenderer;
use toubeelib\core\services\SignInService;
use toubeelib\domain\dto\CredentialsDTO;
use toubeelib\infrastructure\providers\AuthnProviderInterface;
use toubeelib\domain\exceptions\RepositoryEntityNotFoundException;

class SignInAction
{
    private $authnProvider;

    public function __construct(AuthnProviderInterface $authnProvider)
    {
        $this->authnProvider = $authnProvider;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $credentials = new CredentialsDTO($email, $password);

        try {
            $authDto = $this->authnProvider->signIn($credentials);

            $response->getBody()->write(json_encode([
                'token' => $authDto->accessToken,
                'refreshToken' => $authDto->refreshToken,
                'user' => [
                    'id' => $authDto->id,
                    'email' => $authDto->email,
                    'role' => $authDto->role,
                ]
            ]));

            return $response;

        } catch (RepositoryEntityNotFoundException $e) {
            return $response;
        }
    }
}
