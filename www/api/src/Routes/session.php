<?php

use App\Http\Controllers\SessionController;

$sessionController = new SessionController();

$router->add('POST', '/session', function () use ($sessionController) {

    $data = json_decode(file_get_contents("php://input"), true);
    echo $sessionController->store($data);
});
