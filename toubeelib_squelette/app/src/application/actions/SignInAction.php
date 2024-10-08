<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use toubeelib\application\renderer\JsonRenderer;
use toubeelib\core\services\praticien\SignInService;
use toubeelib\core\services\rdv\ServiceRDV;

class SignInAction
{
    private SignInService $signInService;

    // Injection du ServiceRDV via le constructeur
    public function __construct(SignInService $signInService)
    {
        $this->$signInService = $signInService;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        try {
            $user = $this->signInService->getUserById($id);
        } catch(\HttpInvalidParamException) {

        }
        return JsonRenderer::render($response, 200, $user);
    }
}
