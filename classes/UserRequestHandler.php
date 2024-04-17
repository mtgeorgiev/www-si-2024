<?php

class UserRequestHandler {

    private $connection;

    public function __construct()
    {
        $this->connection = (new Db())->getConnection();
    }

    public function createUser($userData): ?User
    {
        $name = $userData['name'];
        $password = $userData['password'];

        $insertStatement = $this->connection->prepare("INSERT INTO users (name, password) VALUES (:name, :password)");
        $insertResult = $insertStatement->execute(['name' => $name, 'password' => $password]);

        if (!$insertResult) 
        {
            if ($insertStatement->errorInfo()[1] == 1062) 
            {
                throw new DuplicateUserException("User with name $name already exists");
            }

            return null;
        }

        $id = $this->connection->lastInsertId();

        $selectStatement = $this->connection->prepare("SELECT * FROM users WHERE id = ?");
        $selectResult = $selectStatement->execute([$id]);

        if (!$selectResult) 
        {
            // something very wrong has happened
            return null;
        }
        $userData = $selectStatement->fetch();

        return User::fromArray($userData);
    }

    public static function getUserInfo()
    {
        // get user info
    }

    public static function updateUser()
    {
        // update user info
    }

    public static function deleteUser()
    {
        // delete user
    }

}