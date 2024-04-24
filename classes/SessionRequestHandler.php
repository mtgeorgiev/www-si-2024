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
        $stmt->execute(['name' => $data['name']]);
        $user = $stmt->fetch();

        if ($user && password_verify($data['password'], $user['password']))
        {
            $_SESSION['username'] = $user['name'];
            return User::fromArray($user);
        }

        return null;
    }

    public function checkLoginStatus(): ?array
    {
        return isset($_SESSION['username']) ? ['name' => $_SESSION['username']] : null;
    }

    public function logout(): bool
    {
        session_destroy();

        return true;
    }
}