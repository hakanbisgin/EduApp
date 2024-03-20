<?php

namespace App\Models;

class User extends Model
{
    public function login($email, $password)
    {
        $stmt = self::$db->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user && password_verify(hash_hmac("sha256", $password, config('app.pepper')), $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($name, $surname, $email, $password)
    {
        $stmt = self::$db->conn->prepare("INSERT INTO users (name, surname, email, password) VALUES (:name, :surname, :email, :password)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email', $email);
        $password_hash = hash_hmac("sha256", $password, config('app.pepper'));
        $password_hash = password_hash($password_hash, PASSWORD_ARGON2ID);
        $stmt->bindParam(':password', $password_hash);
        return $stmt->execute();
    }

    public function exists($email)
    {
        $stmt = self::$db->conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();
        if ($user) {
            return true;
        }
        return false;
    }
}
