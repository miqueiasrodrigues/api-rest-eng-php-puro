<?php

namespace App\Http\Repositories;

use App\Http\Models\Camera;
use App\Http\Repositories\Repository;
use PDO;

class CameraRepository extends Repository
{

    private $userTable;

    public function __construct()
    {
        $this->userTable = "users";
        parent::__construct('cameras', new Camera);
    }


    protected function userIdFind($id)
    {
        $query = "SELECT * FROM " . $this->userTable. " WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
            
}
