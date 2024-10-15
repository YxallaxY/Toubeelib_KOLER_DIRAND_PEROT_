<?php
declare(strict_types=1);

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

return function( \Slim\App $app):\Slim\App {

    $app->get('/', \toubeelib\application\actions\HomeAction::class);

    $app->get('/rdvs/{id}', \toubeelib\application\actions\RdvActionGetRdv::class);

    //$app->get('/user/{id}', \toubeelib\application\actions\SignInAction::class);

    $app->post('/signin', \toubeelib\application\actions\SignInAction::class);

    return $app;
};