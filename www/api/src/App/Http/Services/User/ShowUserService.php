<?php

namespace App\Http\Services\User;

use App\Http\Repositories\UserRepository;

class ShowUserService extends UserRepository
{
    public function execute(int $id)
    {
        $object = $this->find($id);
        
        if ($object === false) {
            return null;
        }

        return $object;
    }
}
