<?php

declare(strict_types=1);

class PasswordValidator
{
    public function validate(string $password): bool
    {
        if (strlen($password) < 8) {
            return false;
        }

        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        return true;
    }
}
