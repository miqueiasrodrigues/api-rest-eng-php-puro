<?php

use App\Http\Controllers\UserController;

$userController = new UserController();

$router->add('GET', '/user', function () use ($userController) {
    echo $userController->index();
});

$router->add('GET', '/user/' . $id, function ($id) use ($userController) {
    echo $userController->show($id);
});

$router->add('POST', '/user', function () use ($userController) {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $userController->store($data);
});

$router->add('PUT', '/user/' . $id, function ($id) use ($userController) {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $userController->update($id, $data);
});

$router->add('DELETE', '/user/' . $id, function ($id) use ($userController) {

    echo $userController->destroy($id);
});
