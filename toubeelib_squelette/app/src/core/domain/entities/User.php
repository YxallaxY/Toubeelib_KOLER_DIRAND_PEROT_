<?php

namespace toubeelib\core\domain\entities\praticien;

use toubeelib\core\domain\entities\Entity;

class User extends Entity
{

    protected string $uuid;
    protected string $email;
    protected string $password;
    protected int $role;

    public function __construct(string $ID, string $label, string $description)
    {
        $this->ID = $ID;
        $this->label = $label;
        $this->description = $description;
    }

    public function toDTO(): SpecialiteDTO
    {
        //return new SpecialiteDTO($this->ID, $this->label, $this->description);

    }
}