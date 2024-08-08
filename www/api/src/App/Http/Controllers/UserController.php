<?php

namespace App\Http\Controllers;

use App\Http\Services\User\CreateUserService;
use App\Http\Services\User\DeleteUserService;
use App\Http\Services\User\ListUserService;
use App\Http\Services\User\ShowUserService;
use App\Http\Services\User\UpdateUserService;
use App\Response;

class UserController extends Controller
{
    public function __construct()
    {
        parent::__construct("Usuário");

        $this->listService = new ListUserService();
        $this->showService = new ShowUserService();
        $this->createService = new CreateUserService();
        $this->updateService = new UpdateUserService();
        $this->deleteService = new DeleteUserService();
    }

    public function index()
    {
        $array = $this->listService->execute();

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
