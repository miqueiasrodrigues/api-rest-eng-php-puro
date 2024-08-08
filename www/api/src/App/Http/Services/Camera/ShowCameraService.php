<?php

namespace App\Http\Services\Camera;

use App\Http\Repositories\CameraRepository;

class ShowCameraService extends CameraRepository
{
    public function execute(int $id)
    {
        $object = $this->find($id);
        
        if ($object === false) {
            return null;
        }

        return $object;
    }
}
