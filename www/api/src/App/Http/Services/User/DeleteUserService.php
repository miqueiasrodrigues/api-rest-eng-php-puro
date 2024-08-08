<?php

namespace App\Http\Services\User;

use App\Http\Repositories\UserRepository;

class DeleteUserService extends UserRepository
{
    public function execute(int $id)
    {
        if ($this->find($id) === false) {
            return null;
        }

        $this->delete($id);

        return [];
    }
}
