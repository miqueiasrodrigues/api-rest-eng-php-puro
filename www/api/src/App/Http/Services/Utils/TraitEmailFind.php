<?php

namespace App\Http\Services\Utils;

use App\Exceptions\AppException;

trait TraitEmailFind
{
    public function traitEmailFind($result)
    {
        if ($result !== false) {
            throw new AppException(400, "E-mail já existe.");
            return;
        }
    }
}
