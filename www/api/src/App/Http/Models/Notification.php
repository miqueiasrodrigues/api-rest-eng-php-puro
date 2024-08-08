<?php

namespace App\Http\Models;

use App\Http\Models\Model;

class Notification extends Model
{
    public function __construct()
    {
        parent::__construct(['user_id', 'image_url', 'amount_people'], [
            'user_id' => 'required|number',
            'image_url' => 'required|string',
            'amount_people' => 'required|number',
        ]);
    }
}
