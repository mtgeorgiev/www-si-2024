<?php

class Session
{

    public static function setLoggedState(string $username): void
    {
        $_SESSION['username'] = $username;
    }

    public static function isLogged(): bool
    {
        return isset($_SESSION['username']);
    }

    public static function getUsername(): ?string
    {
        return isset($_SESSION['username']) ? $_SESSION['username'] : null;
    }

}