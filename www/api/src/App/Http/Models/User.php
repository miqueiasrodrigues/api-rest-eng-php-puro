<?php

namespace App\Http\Models;

use App\Http\Models\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct(['name', 'email', 'password'], [
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
    }
}
