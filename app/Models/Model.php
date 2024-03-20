<?php

namespace App\Models;

class Model
{
    public static $db;
    public $table;
    public $name;
    public $pluralName;
    public $attributes = [];

    public function __construct()
    {
        if (!self::$db) {
            self::$db = new Database();
        }
        $this->pluralName = $this->table;
    }

    public function all($filters = [])
    {
        $query = "SELECT * FROM " . $this->table;
        if (!empty($filters)) {
            $query .= " WHERE ";
            foreach ($filters as $key => $value) {
                $query .= "$key = $value AND ";
            }
            $query = rtrim($query, " AND ");
        }
        $stmt = self::$db->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function find($id)
    {
        $stmt = self::$db->conn->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create(...$params)
    {
        $stmt = self::$db->conn->prepare("INSERT INTO " . $this->table .
            " (" . implode(',', $this->attributes) .
            ") VALUES (" . rtrim(str_repeat('?,', count($this->attributes)), ',') . ")");
        return $stmt->execute(array_values($params));
    }

    public function update($id, ...$params)
    {
        $stmt = self::$db->conn->prepare("UPDATE " . $this->table . " SET " . implode(' = ?, ', $this->attributes) . " = ? WHERE id = ?");
        return $stmt->execute(array_merge(array_values($params), [$id]));
    }

    public function delete($id)
    {
        $stmt = self::$db->conn->prepare("DELETE FROM " . $this->table . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function whereFirst($column, $value)
    {
        $stmt = self::$db->conn->prepare("SELECT * FROM " . $this->table . " WHERE $column = :value LIMIT 1");
        $stmt->bindParam(":value", $value);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function where(array $wheres, $operator = 'AND')
    {
        foreach ($wheres as $where) {

            $_wheres[] = "$where[0] $where[1] :$where[0]";
            $_bindings[":$where[0]"] = $where[2];
        }
        $where = implode(" $operator ", $_wheres);
        $stmt = self::$db->conn->prepare("SELECT * FROM " . $this->table . " WHERE $where");
        $stmt->execute($_bindings);
        return $stmt->fetchAll();
    }

}