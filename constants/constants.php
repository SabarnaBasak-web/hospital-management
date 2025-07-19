<?php

class UserRole
{
    public const SUPERADMIN = 'Super Admin';
    public const ADMIN = 'Admin';
    public const STAFF = 'Staff';

    public static function getAllRoles(): array
    {
        return [
            self::SUPERADMIN,
            self::ADMIN,
            self::STAFF
        ];
    }

    public static function isValidRole(string $role): bool
    {
        return in_array($role, self::getAllRoles());
    }

    public static function isSuperAdmin(): bool
    {
        return $_SESSION['role'] == self::SUPERADMIN;
    }
}
