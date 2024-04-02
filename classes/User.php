<?php

class User
{
    private $name;
    private $password;

    public function __construct(string $name, string $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    // getters and setters
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public static function fromArray(array $data): User
    {
        return new User($data['name'], $data['password']);
    }

    public function __toString(): string
    {
        return json_encode($this, JSON_UNESCAPED_UNICODE);
    }
}