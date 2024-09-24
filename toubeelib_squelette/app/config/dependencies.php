<?php

use Psr\Container\ContainerInterface;
use toubeelib\core\services\rdv\ServiceRDV;
use toubeelib\core\services\praticien\ServicePraticien;
use toubeelib\infrastructure\repositories\ArrayRdvRepository;
use toubeelib\infrastructure\repositories\ArrayPraticienRepository;
use toubeelib\application\actions\RdvActionGetRdv;

return [

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

];
