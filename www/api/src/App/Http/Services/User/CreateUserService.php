<?php

namespace App\Http\Services\User;

use App\Http\Repositories\UserRepository;
use App\Http\Services\Utils\TraitEmailFind;

class CreateUserService extends UserRepository
{
    use TraitEmailFind;
    public function execute(array $data)
    {
        if (isset($data['email']) && !empty($data['email'])) {
            $this->traitEmailFind($this->emailFind($data['email']));
        }

        $id = $this->save($data);

        return  $this->find($id);
    }
}
