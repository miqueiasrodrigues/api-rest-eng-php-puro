<?php

namespace App\Http\Repositories;

use App\Http\Models\Notification;
use App\Http\Repositories\Repository;
use PDO;

class NotificationRepository extends Repository
{

    private $userTable;

    public function __construct()
    {
        $this->userTable = "users";
        parent::__construct('notifications', new Notification);
    }


    protected function userIdFind($id)
    {
        $query = "SELECT * FROM " . $this->userTable. " WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
            
}
