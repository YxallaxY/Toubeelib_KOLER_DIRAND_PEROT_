<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class RdvAction extends AbstractAction
{


    public function __invoke(ServerRequestInterface $rq, ResponseInterface $rs, array $args): ResponseInterface {
        $id = $args['id'];

        $data = [
            'self' => $id,
            'praticien' => ['id' => '1'],
            'patient' => ['id' => '1']
        ];

        // Set the content type to JSON
        $response = $rs->withHeader('Content-Type', 'application/json');

        // Write the JSON data to the response body
        $response->getBody()->write(json_encode($data));

        return $response;
    }

}