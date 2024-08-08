<?php

namespace App\Http\Services\User;

use App\Http\Repositories\UserRepository;
use App\Http\Services\Utils\TraitEmailFind;

class UpdateUserService extends UserRepository
{
    use TraitEmailFind;

    public function execute(int $id, array $data)
    {
        if ($this->find($id) === false) {
            return null;
        }

        if (isset($data['email']) && !empty($data['email'])) {
            $this->traitEmailFind($this->emailFind($data['email']));
        }

        $this->update($id, $data);

        return $this->find($id);
    }
}
