<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use toubeelib\application\renderer\JsonRenderer;
use toubeelib\core\services\rdv\ServiceRDV;

class RdvActionGetRdv
{
    private $serviceRdv;

    // Injection du ServiceRDV via le constructeur
    public function __construct(ServiceRDV $serviceRdv)
    {
        $this->serviceRdv = $serviceRdv;
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        try {
            $rdvs = $this->serviceRdv->getRDVById($id);
        } catch(\HttpInvalidParamException) {

        }
        return JsonRenderer::render($response, 200, $rdvs);
    }
}
