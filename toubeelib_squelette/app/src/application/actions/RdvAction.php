<?php

namespace toubeelib\application\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use toubeelib\application\dto\RdvDTO;

class RdvAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $method = $request->getMethod();

        switch ($method) {
            case 'GET':
                return $this->handleGet($request, $response, $args);
            case 'PATCH':
                return $this->handlePatch($request, $response, $args);
            case 'POST':
                return $this->handlePost($request, $response);
            default:
                $response->getBody()->write(json_encode(['error' => 'Method not allowed']));
                return $response->withStatus(405)->withHeader('Content-Type', 'application/json');
        }
    }

    private function handleGet(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];

        $data = [
            'id' => $id,
            'self' => ["href" => ""],
            'praticien' => ["id" => "XXX"],
            'patient' => ["id" => "XXX"],
            'date' => $body['date'] ?? 'Updated date',
            'time' => $body['time'] ?? 'Updated time'
        ];

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($data));

        return $response;
    }

    private function handlePatch(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $body = $request->getParsedBody();

        $data = [
            'id' => $id,
            'self' => ["href" => ""],
            'praticien' => ["id" => "XXX"],
            'patient' => ["id" => "XXX"],
            'date' => $body['date'] ?? 'Updated date',
            'time' => $body['time'] ?? 'Updated time'
        ];

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode(['status' => 'success', 'data' => $data]));

        return $response;
    }

    private function handlePost(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $rdvDTO = new RdvDTO($body);

        // Process the POST request with the DTO
        $responseData = [
            'status' => 'success',
            'data' => $rdvDTO
        ];

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(json_encode($responseData));

        return $response;
    }
}
