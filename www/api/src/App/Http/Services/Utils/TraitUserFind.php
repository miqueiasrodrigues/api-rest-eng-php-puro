<?php

namespace App\Http\Services\Utils;

use App\Exceptions\AppException;

trait TraitUserFind
{
    public function traitUserFind($result)
    {
        $isExistUser = $result;

        if ($isExistUser === false) {
            throw new AppException(400, "Usuário não existe.");
            return;
        }
    }
}
