<?php

namespace App\Http\Services\Camera;

use App\Http\Repositories\CameraRepository;
use App\Http\Services\Utils\TraitUserFind;

class UpdateCameraService extends CameraRepository
{
    use TraitUserFind;

    public function execute(int $id, array $data)
    {
        if ($this->find($id) === false) {
            return null;
        }

        if (isset($data['user_id']) && !empty($data['user_id'])) {
            $this->traitUserFind($this->userIdFind($data['user_id']));
        }

        $this->update($id, $data);

        return $this->find($id);
    }
}
