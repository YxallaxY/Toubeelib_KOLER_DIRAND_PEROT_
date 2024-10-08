<?php

namespace toubeelib\core\middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Slim\Psr7\Request;

class AuthnMiddleware
{
    private string $secret = "";

    public function __invoke(Request $request, callable $next): Response
    {
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return $this->unauthorizedResponse();
        }

        $tokenString = sscanf($authHeader, "Bearer %s")[0];

        try {
            $decodedToken = JWT::decode($tokenString, new Key($this->secret, 'HS512'));
            $request = $request->withAttribute('user', $decodedToken->sub);
            return $next($request);
        } catch (ExpiredException $e) {
            return $this->unauthorizedResponse('Token has expired.');
        } catch (SignatureInvalidException $e) {
            return $this->unauthorizedResponse('Invalid token signature.');
        } catch (BeforeValidException $e) {
            return $this->unauthorizedResponse('Token not valid yet.');
        } catch (\UnexpectedValueException $e) {
            return $this->unauthorizedResponse('Unexpected value in token.');
        }
    }

    private function unauthorizedResponse(?string $message = null): Response
    {
        $response = new \Slim\Psr7\Response();
        $response->getBody()->write(json_encode(['error' => $message ?? 'Unauthorized']));
        return $response->withStatus(401)
            ->withHeader('Content-Type', 'application/json');
    }
}
