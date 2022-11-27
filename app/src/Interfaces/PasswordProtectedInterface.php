<?php

namespace App\Interfaces;

interface PasswordProtectedInterface
{
    public function hashPassword(string $plainPassword): string;

    public function passwordMatch(string $plainPwd): bool;
}
