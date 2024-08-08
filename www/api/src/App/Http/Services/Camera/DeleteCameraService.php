<?php

namespace App\Http\Services\Camera;

use App\Http\Repositories\CameraRepository;

class DeleteCameraService extends CameraRepository
{
    public function execute(int $id)
    {
        if ($this->find($id) === false) {
            return null;
        }

        $this->delete($id);

        return [];
    }
}
