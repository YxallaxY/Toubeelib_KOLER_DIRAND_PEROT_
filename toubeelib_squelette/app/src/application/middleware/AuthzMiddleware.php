<?php

class AuthzMiddleware
{
    private $authzService;

    public function __construct(AuthzServiceInterface $authzService)
    {
        $this->authzService = $authzService;
    }

    public function handle($request, $next)
    {
        if (!$this->authzService->authorize($request->user, $request->action)) {
            return response('Forbidden', 403);
        }

        return $next($request);
    }
}
