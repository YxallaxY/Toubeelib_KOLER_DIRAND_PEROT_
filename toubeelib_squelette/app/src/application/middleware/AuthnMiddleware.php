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
    private $authnProvider;

    public function __construct(AuthnProviderInterface $authnProvider)
    {
        $this->authnProvider = $authnProvider;
    }

    public function handle($request, $next)
    {
        $token = $request->getHeader('Authorization');
        $user = $this->authnProvider->getSignedInUser($token);

        if (!$user) {
            return response('Unauthorized', 401);
        }

        $request->user = $user;
        return $next($request);
    }
}
