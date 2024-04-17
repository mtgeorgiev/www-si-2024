<?php

require_once 'bootstrap.php';

switch ($_SERVER['REQUEST_METHOD'])
{
    case 'POST':
        // create user (register)
        $result = (new UserRequestHandler())->createUser($_POST);
        break;
    case 'GET':
        // get user info
        $result = UserRequestHandler::getUserInfo();
        break;
    case 'PUT':
        // update user info
        $result = UserRequestHandler::updateUser();
        break;
    case 'DELETE':
        // delete user
        $result = UserRequestHandler::deleteUser();
        break;
    default:
        // unknown request method
        break;
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);
