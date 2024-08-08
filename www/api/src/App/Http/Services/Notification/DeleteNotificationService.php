<?php

namespace App\Http\Services\Notification;

use App\Http\Repositories\NotificationRepository;
use Config\Classes\Upload;

class DeleteNotificationService extends NotificationRepository
{
    public function execute(int $id)
    {
        $data = $this->find($id);

        if ($data === false) {
            return null;
        }

        $this->delete($id);

        $update = new Upload();

        if (isset($data['image_url'])) {
            $update->remove($data['image_url']);
        }

        return [];
    }
}
