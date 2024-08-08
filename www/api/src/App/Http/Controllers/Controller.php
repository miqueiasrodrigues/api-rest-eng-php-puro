<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected $listService;
    protected $showService;
    protected $createService;
    protected $updateService;
    protected $deleteService;

    private $controllerName;
    private $plural;

    public function __construct(string $controllerName = "", string $plural = null)
    {
        $this->controllerName = $controllerName;
        $this->plural = $plural;
    }

    abstract protected function index();
    abstract protected function show(int $id);
    abstract protected function store(array $data);
    abstract protected function update(int $id, array $data);
    abstract protected function destroy(int $id);

    protected function responseMessageIndex($customMessage = null)
    {
        return $customMessage !== null ? $customMessage : ($this->plural !==  null ? $this->plural : $this->controllerName .   's') . ' ' . 'recuperados com sucesso.';
    }

    protected function responseMessageShow($customMessage = null)
    {
        return  $customMessage !== null ? $customMessage : $this->controllerName . ' ' . 'recuperado com sucesso.';
    }

    protected function responseMessageStore($customMessage = null)
    {
        return  $customMessage !== null ? $customMessage : $this->controllerName . ' ' . 'inserido com sucesso.';
    }

    protected function responseMessageUpdate($customMessage = null)
    {
        return  $customMessage !== null ? $customMessage : $this->controllerName . ' ' . 'atualizado com sucesso.';
    }

    protected function responseMessageDestroy($customMessage = null)
    {
        return  $customMessage !== null ? $customMessage : $this->controllerName . ' ' . 'excluído com sucesso.';
    }

    protected function responseMessageNotFound($customMessage = null)
    {
        return  $customMessage !== null ? $customMessage : $this->controllerName . ' ' . 'não encontrado';
    }
}
