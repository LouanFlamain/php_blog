<?php

namespace App\Entity;

use App\Interfaces\PasswordProtectedInterface;
use App\Interfaces\UserInterface;

class User extends BaseEntity implements UserInterface, PasswordProtectedInterface
{
    private ?int $id;
    private string $user;
    private string $password;
    private string $type;



    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param int $id
     * @return User
     */
    public function setId(int $id): User
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser(): string
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return User
     */
    public function setUser(string $user): User
    {
        $this->user = $user;
        return $this;
    }

    public function hashPassword(string $plainPassword): string
    {
        $password = password_hash($plainPassword, PASSWORD_DEFAULT);
        return $password;
    }

    public function passwordMatch(string $plainPwd): bool
    {
        return password_verify($plainPwd, $this->password);
    }
    public function getType(): string
    {
        $type = 'user';
        return $type;
    }
    public function getTypeUser(): string
    {
        return $this->type;
    }

    public function setType(string $type): User
    {
        $this->type = $type;
        return $this;
    }
}
