<?php

namespace App\Http\Services\Notification;

use App\Http\Repositories\NotificationRepository;

class ShowNotificationService extends NotificationRepository
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
