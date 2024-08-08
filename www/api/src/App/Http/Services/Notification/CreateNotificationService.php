<?php

namespace App\Http\Services\Notification;

use App\Http\Repositories\NotificationRepository;
use App\Http\Services\Utils\TraitUserFind;

class CreateNotificationService extends NotificationRepository
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
