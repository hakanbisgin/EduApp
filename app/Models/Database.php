<?php

namespace App\Models;

use PDO;
use PDOException;

class Database
{
    public $conn;

    public function __construct()
    {
        $config = config('app.database');
        try {
            $this->conn = new PDO(
                "mysql:host={$config['host']};dbname={$config['name']}",
                $config['username'],
                $config['password']
            );
            //$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }

    }
}