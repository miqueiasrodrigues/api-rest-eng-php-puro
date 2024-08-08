<?php

namespace App\Http\Services\User;

use App\Http\Repositories\UserRepository;

class ListUserService extends UserRepository
{
    public function execute()
    {
        $array = $this->find(null, [], true);

        if ($array === []) {
            $array = null;
        }

        return $array;
    }
}
