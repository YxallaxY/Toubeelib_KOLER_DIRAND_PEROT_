<?php

namespace toubeelib\core\dto;

class UserDTO extends DTO
{
    protected string $id;
    protected string $email;
    protected string $name;
    protected int $role;

    public function __construct(string $id, string $email, string $name, int $role) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->role = $role;
    }
}
