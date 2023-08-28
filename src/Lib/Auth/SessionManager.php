<?php namespace Holamanola45\Www\Lib\Auth;

use Holamanola45\Www\Lib\Error\UnauthorizedException;

class SessionManager {
    public static function load() {
        session_start();
    }

    public static function destroy() {
        session_unset();
        session_destroy();
    }

    public static function setUser(int $userId, string $username) {
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
    }

    public static function isLoggedIn() {
        return isset($_SESSION['userId']);
    }

    public static function verifyLoggedIn() {
        if (!self::isLoggedIn()) {
            throw new UnauthorizedException('You need to be logged in to access this document.');
        }
    }
}