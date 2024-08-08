<?php

namespace App\Http\Models;

use App\Http\Models\Model;

class Session extends Model
{
    public function __construct()
    {
        parent::__construct(['email', 'password'], [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
