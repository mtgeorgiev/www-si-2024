<?php

class SessionRequestHandler
{
    private $connection;

    public function __construct()
    {
        $this->connection = (new Db())->getConnection();
    }

    public function login(array $data): ?User
    {
        $stmt = $this->connection->prepare('SELECT * FROM users WHERE name = :name');
        $stmt->execute(['name' => $data['username']]);
        $user = $stmt->fetch();

        if ($user && password_verify($data['password'], $user['password']))
        {
            Session::setLoggedState($user['name']);
            return User::fromArray($user);
        }

        return null;
    }

    public function checkLoginStatus(): ?array
    {
        return Session::isLogged() ? ['name' => Session::getUsername()] : null;
    }

    public function logout(): bool
    {
        session_destroy();

        return true;
    }
}