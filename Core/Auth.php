<?php

namespace Core;

class Auth
{
    public static function requireLogin()
    {
        if (!isset($_SESSION['user'])) {
            header('location: /login');
            exit();
        }
    }

    public static function requireRole($roles)
    {
        self::requireLogin();

        if (is_string($roles)) {
            $roles = [$roles];
        }

        if (!in_array($_SESSION['user']['role'], $roles)) {
            abort(403);
        }
    }

    public static function isAdmin()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin';
    }

    public static function isTeknisi()
    {
        return isset($_SESSION['user']) && $_SESSION['user']['role'] === 'teknisi';
    }

    public static function isAdminOrTeknisi()
    {
        return self::isAdmin() || self::isTeknisi();
    }

    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCsrfToken($token)
    {
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
}
