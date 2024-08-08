<?php

use App\Http\Controllers\CameraController;

$cameraController = new CameraController();

$router->add('GET', '/camera(.*)', function () use ($cameraController) {
    echo $cameraController->index($_GET);
});

$router->add('GET', '/camera/' . $id, function ($id) use ($cameraController) {
    echo $cameraController->show($id);
});

$router->add('POST', '/camera', function () use ($cameraController) {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $cameraController->store($data);
});

$router->add('PUT', '/camera/' . $id, function ($id) use ($cameraController) {
    $data = json_decode(file_get_contents("php://input"), true);
    echo $cameraController->update($id, $data);
});


$router->add('DELETE', '/camera/' . $id, function ($id) use ($cameraController) {

    echo $cameraController->destroy($id);
});
