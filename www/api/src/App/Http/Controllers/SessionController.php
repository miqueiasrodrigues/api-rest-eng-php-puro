<?php

namespace App\Http\Controllers;

use App\Http\Services\Session\CreateSessionService;
use App\Response;

class SessionController extends Controller
{
    public function __construct()
    {
        parent::__construct("Sessão", "Sessões");
        $this->createService = new CreateSessionService();
    }

    public function index()
    {
    }

    public function show(int $id)
    {
    }

    public function store(array $data)
    {
        $object = $this->createService->execute($data);

        if ($object === null) {
            return Response::json(404, $this->responseMessageNotFound("E-mail e senha não coincidem."));
        }

        return Response::json(201, $this->responseMessageStore("Sessão iniciada com sucesso."), $object);
    }

    public function update(int $id, array $data)
    {
    }

    public function destroy(int $id)
    {
    }
}
