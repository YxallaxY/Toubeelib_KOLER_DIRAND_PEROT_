<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class RdvActionGetRdv
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        $data = [
            'status' => 'success',
            'id' => $id,
            'self' => ["href" => "XXX"],
            'praticien' => ["id" => "XXX"],
            'patient' => ["id" => "XXX"],
            'date' => 'XXX',
            'time' => 'XXX'
        ];

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));

        return $response;


    }

}
