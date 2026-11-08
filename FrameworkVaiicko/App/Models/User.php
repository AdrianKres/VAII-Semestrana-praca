<?php

namespace App\Models;

use Framework\Core\Model;

class User extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $email = null;
    protected ?string $password = null;
    protected ?string $role = 'user';

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }
    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): void { $this->email = $email; }
    public function getPassword(): ?string { return $this->password; }
    public function setPassword(string $password): void { $this->password = $password; }
    public function getRole(): ?string { return $this->role; }
    public function setRole(string $role): void { $this->role = $role; }
}