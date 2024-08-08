<?php

namespace App\Http\Repositories;

use App\Http\Models\User;
use App\Http\Repositories\Repository;
use PDO;

class UserRepository extends Repository
{

    public function __construct()
    {
        parent::__construct('users', new User);
        
    }

    protected function emailFind($email)
    {
        $query = "SELECT * FROM " . $this->tableName. " WHERE email = ?";

        $stmt = $this->db->prepare($query);

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    protected function accountFind($email, $password)
    {
        $query = "SELECT * FROM " . $this->tableName. " WHERE email = ? AND password = ?";

        $stmt = $this->db->prepare($query);

        $stmt->execute([$email, $password]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
            
}
