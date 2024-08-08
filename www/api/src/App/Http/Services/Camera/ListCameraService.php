<?php

namespace App\Http\Services\Camera;

use App\Http\Repositories\CameraRepository;


class ListCameraService extends CameraRepository
{
    public function execute(array $param)
    {
        $array = $this->find(null, $param, true);

        if ($array === []) {
            $array = null;
        }

        return $array;
    }
}
