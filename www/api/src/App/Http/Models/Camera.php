<?php

namespace App\Http\Models;

use App\Http\Models\Model;

class Camera extends Model
{
    public function __construct()
    {
        parent::__construct(['user_id', 'url', 'model', 'brand', 'start_monitoring', 'end_monitoring'], [
            'user_id' => 'required|number',
            'url' => 'required|string',
            'model' => 'required|string',
            'brand' => 'required|string',
            'start_monitoring' => 'required|string',
            'end_monitoring' => 'required|string'
        ]);
    }
}
