<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
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

        $rdvs = $this->serviceRdv->getRDVById($id);

        $data = $rdvs->toJSON();
        $response->getBody()->write($data);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}
