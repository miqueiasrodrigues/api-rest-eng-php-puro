<?php

use App\Http\Controllers\NotificationController;
use Config\Classes\Upload;

require_once __DIR__.'/../Config/Classes/Update.php';

$notificationController = new NotificationController();

$router->add('GET', '/notification(.*)', function () use ($notificationController) {   
    echo $notificationController->index($_GET);
});

$router->add('GET', '/notification/' . $id, function ($id) use ($notificationController) {
    echo $notificationController->show($id);
});

$router->add('POST', '/notification', function () use ($notificationController) {
    $data = $_POST;
    
    $upload = new Upload('image_url');
    
    $imageData = $upload->upload();
    
    if($imageData['status'] === "success"){
        $data['image_url'] = $imageData['data'];
    }

    echo $notificationController->store($data);
});

$router->add('DELETE', '/notification/' . $id, function ($id) use ($notificationController) {

    echo $notificationController->destroy($id);
});
