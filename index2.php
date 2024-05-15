<?php

require_once 'bootstrap.php';

    if (!Session::isLogged())
    {
        header('Location: login.php');
        exit;
    }
?>

<!-- това не работи, само за пример е! -->
<?php if (!Session::isLogged()): ?>
    <a href="login.php">Вход</a>
    <a href="register.php">Регистрация</a>
<?php else :?>
    <a href="logout.php">Изход</a>
<?php endif?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <title>Заглавие</title>
        <link href="./style.css" rel="stylesheet">
    </head>
    <body>
        <content>
            <?php
                $connection = (new Db())->getConnection();

                $selectStatement = $connection->prepare("SELECT * FROM `users`");
                $selectResult = $selectStatement->execute();
        
                if (!$selectResult) 
                {
                    // something very wrong has happened
                    $userData = [];
                } else {    
                    $users = $selectStatement->fetchAll();
            
                    $userData = array_map(function($userData) {
                        return User::fromArray($userData);
                    }, $users);
                }
            ?>

            <?php foreach ($userData as $user) : ?>
                <div class="user">
                    <div class="user-info">
                        <div class="user-info-item">Име: <?= $user->getName() ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </content>
    </body>
</html>
