<?php

namespace App\Http\Controllers;

use App\Http\Services\Notification\CreateNotificationService;
use App\Http\Services\Notification\DeleteNotificationService;
use App\Http\Services\Notification\ListNotificationService;
use App\Http\Services\Notification\ShowNotificationService;

use App\Response;

class NotificationController extends Controller
{
    public function __construct()
    {
        parent::__construct("Notificação", "Notificações");
        $this->listService = new ListNotificationService();
        $this->showService = new ShowNotificationService();
        $this->createService = new CreateNotificationService();
        $this->deleteService = new DeleteNotificationService();
    }

    public function index(array $param = [])
    {
        $array = $this->listService->execute($param);

        if ($array === null) {
            return Response::json(404, $this->responseMessageNotFound());
        }

        return Response::json(200, $this->responseMessageIndex(), $array);
    }

    public function show(int $id)
    {
        $object = $this->showService->execute($id);

        if ($object === null) {
            return Response::json(404,  $this->responseMessageNotFound());
        }

        return Response::json(200, $this->responseMessageShow(), $object);
    }

    public function store(array $data)
    {
        $object = $this->createService->execute($data);

        return Response::json(201, $this->responseMessageStore(), $object);
    }

    public function update(int $id, array $data)
    {
    }

    public function destroy(int $id)
    {
        $object = $this->deleteService->execute($id);

        if ($object === null) {
            return Response::json(404,  $this->responseMessageIndex());
        }

        return Response::json(200, $this->responseMessageDestroy());
    }
}
