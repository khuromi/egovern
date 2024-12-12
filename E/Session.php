<?php

declare(strict_types=1);

class Session extends \SessionHandler
{
    private static ?self $_instance = null;

    public function __construct(
        private readonly string $sessionName = 'my_secure_session',
        private readonly int $sessionMaxLifetime = 1800, // 30 minutes
        private readonly bool $sessionSSL = true,
        private readonly bool $sessionHTTPOnly = true,
        private readonly string $sessionSameSite = 'Strict'
    ) {
   

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function startSession(): void
    {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
    }

    public static function setSession(string $index, mixed $value): void
    {
        $_SESSION[$index] = $value;
    }

    public static function getSession(string $index): mixed
    {
        return $_SESSION[$index] ?? null;
    }

    public static function checkSession(string $index): bool
    {
        return isset($_SESSION[$index]);
    }

    public static function unsetSession(string $index): void
    {
        unset($_SESSION[$index]);
    }

    public static function destroySession(): bool
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            return session_destroy();
        }
        return false;
    }

    // Prevent cloning of the instance
    private function __clone()
    {
    }

    // Prevent unserialization of the instance
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize singleton");
    }
}
