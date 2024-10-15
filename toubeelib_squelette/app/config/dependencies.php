<?php

use Psr\Container\ContainerInterface;
use toubeelib\core\services\rdv\ServiceRDV;
use toubeelib\core\services\praticien\ServicePraticien;
use toubeelib\infrastructure\repositories\ArrayRdvRepository;
use toubeelib\infrastructure\repositories\ArrayPraticienRepository;
use toubeelib\application\actions\RdvActionGetRdv;
use toubeelib\infrastructure\repositories\DbUserRepository;

use toubeelib\core\services\SignInService;
use toubeelib\application\actions\SignInAction;

return [

    "pdo" => function (ContainerInterface $container) {
        $pdo = new PDO('pgsql:host=toubeelib.db;port=5432;dbname=toubeelib;user=toubeelib;password=toubeelib');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    },

    DbUserRepository::class => function (ContainerInterface $container) {
        return new DbUserRepository($container->get("pdo"));
    },

    ArrayRdvRepository::class => function (ContainerInterface $container) {
        return new ArrayRdvRepository();
    },

    ArrayPraticienRepository::class => function (ContainerInterface $container) {
        return new ArrayPraticienRepository();
    },

    ServicePraticien::class => function (ContainerInterface $container) {
        return new ServicePraticien($container->get(ArrayPraticienRepository::class));
    },

    ServiceRDV::class => function (ContainerInterface $container) {

        // logger dans service, logger dans construct

        return new ServiceRDV(
            $container->get(ServicePraticien::class),
            $container->get(ArrayRdvRepository::class)
        );
    },

    RdvActionGetRdv::class => function (ContainerInterface $container) {
        return new RdvActionGetRdv($container->get(ServiceRDV::class));
    },

    SignInService::class => function (ContainerInterface $container) {
        return new SignInService($container->get(DbUserRepository::class));
    },

    SignInAction::class => function (ContainerInterface $container) {
        return new SignInAction($container->get(SignInService::class));
    },

    JWTAuthnProvider::class => function (ContainerInterface $container) {
        return new JWTAuthnProvider(
            $container->get(JWTManager::class),
            $container->get("pdo")
        );
    }

];
