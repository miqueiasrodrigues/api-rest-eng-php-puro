<?php

namespace App\Http\Services\Notification;

use App\Http\Repositories\NotificationRepository;


class ListNotificationService extends NotificationRepository
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
