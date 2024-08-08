<?php

namespace App\Http\Repositories;

use Database\Connection;
use PDO;

abstract class Repository
{
    protected $tableName;
    private $model;
    protected $db;

    public function __construct($tableName, $model)
    {
        $this->db = Connection::getInstance();
        $this->tableName = $tableName;
        $this->model = $model;
    }

    protected function find($id = null, $params = [], $isArray = false)
    {
        $query = "SELECT * FROM " . $this->tableName;
        $conditions = [];
        $values = [];

        if ($id) {
            $conditions[] = "id = ?";
            $values[] = $id;
        }

        foreach ($params as $key => $value) {
            $conditions[] = "$key = ?";
            $values[] = $value;
        }

        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
        $stmt = $this->db->prepare($query);
        $stmt->execute($values);
        return ($isArray) ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC) ;
    }


    public function save(array $data)
    {
        $dataModel = $this->model->validate($data);

        $keys = array_keys($dataModel);
        $values = array_values($dataModel);

        $columns = implode(', ', $keys);
        $placeholders = implode(', ', array_fill(0, count($keys), '?'));

        $query = "INSERT INTO " . $this->tableName . " (" . $columns . ") VALUES (" . $placeholders . ")";
        $stmt = $this->db->prepare($query);

        $stmt->execute($values);

        return $this->db->lastInsertId();
    }

    public function update(int $id, array $data): void
    {
        $dataModel = $this->model->validate($data);

        $updateFields = array_map(function ($key) {
            return "$key = ?";
        }, array_keys($dataModel));

        $updateFields = implode(', ', $updateFields);

        $values = array_values($dataModel);
        $values[] = $id;

        $query = "UPDATE " . $this->tableName . " SET " . $updateFields . " WHERE id = ?";

        $stmt = $this->db->prepare($query);

        $stmt->execute($values);
    }


    public function delete(int $id): void
    {
        $query = "DELETE FROM " . $this->tableName . " WHERE id = ?";

        $stmt = $this->db->prepare($query);
        $stmt->execute([$id]);
    }
}
