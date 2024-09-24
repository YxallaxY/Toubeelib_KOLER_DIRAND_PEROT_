<?php

namespace toubeelib\core\repositoryInterfaces;

use toubeelib\core\domain\entities\rdv\RendezVous;

interface RdvRepositoryInterface
{

    public function getRDVById(string $id): RendezVous;

}