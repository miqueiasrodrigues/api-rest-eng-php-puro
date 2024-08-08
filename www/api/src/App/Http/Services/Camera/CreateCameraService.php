<?php

namespace App\Http\Services\Camera;

use App\Http\Repositories\CameraRepository;
use App\Http\Services\Utils\TraitUserFind;

class CreateCameraService extends CameraRepository
{
    use TraitUserFind;

    public function execute(array $data)
    {

        if (isset($data['user_id']) && !empty($data['user_id'])) {
            $this->traitUserFind($this->userIdFind($data['user_id']));
        }

        $id = $this->save($data);

        return  $this->find($id);
    }
}
