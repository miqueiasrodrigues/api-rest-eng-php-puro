<?php

namespace App\Http\Controllers;

use App\Http\Services\Camera\CreateCameraService;
use App\Http\Services\Camera\DeleteCameraService;
use App\Http\Services\Camera\ListCameraService;
use App\Http\Services\Camera\ShowCameraService;
use App\Http\Services\Camera\UpdateCameraService;
use App\Response;

class CameraController extends Controller
{
    public function __construct()
    {
        parent::__construct("Câmera");

        $this->listService = new ListCameraService();
        $this->showService = new ShowCameraService();
        $this->createService = new CreateCameraService();
        $this->updateService = new UpdateCameraService();
        $this->deleteService = new DeleteCameraService();
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
        $object = $this->updateService->execute($id, $data);

        if ($object === null) {
            return Response::json(404,  $this->responseMessageNotFound());
        }

        return Response::json(200, $this->responseMessageUpdate(), $object);
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
