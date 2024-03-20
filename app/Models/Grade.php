<?php

namespace App\Models;

class Grade extends Model
{
    public $name = 'grade';
    public $table = 'grades';
    public $attributes = [
        'term_id',
        'course_id',
        'student_id',
        'grade'
    ];

    public function all($filters = [])
    {
        $query = "SELECT g.*, t.name as term, c.name as course, concat(s.name , ' ' , s.surname) as student FROM grades g";
        $query .= " LEFT JOIN terms t ON g.term_id = t.id";
        $query .= " LEFT JOIN courses c ON g.course_id = c.id";
        $query .= " LEFT JOIN students s ON g.student_id = s.id";
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
        $query = "SELECT g.*, t.name as term, c.name as course, concat(s.name , ' ' , s.surname) as student FROM grades g";
        $query .= " JOIN terms t ON g.term_id = t.id";
        $query .= " JOIN courses c ON g.course_id = c.id";
        $query .= " JOIN students s ON g.student_id = s.id";
        $query .= " WHERE g.id = :id";
        $stmt = self::$db->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getTranscript($filters = [])
    {
        $query = "SELECT 
    concat(s.name , ' ' , s.surname) as student,
    t.name as term, 
    c.name as course, 
    c.weight, 
    g.grade,
    g.*
FROM students s";
        $query .= " JOIN grades g ON g.student_id = s.id";
        $query .= " JOIN terms t ON g.term_id = t.id";
        $query .= " JOIN courses c ON g.course_id = c.id";
        if (!empty($filters)) {
            $query .= " WHERE ";
            foreach ($filters as $key => $value) {
                $query .= "$key = $value AND ";
            }
            $query = rtrim($query, " AND ");
        }
        $query .= " ORDER BY g.student_id,  g.term_id, g.course_id";

        $stmt = self::$db->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();

    }

}
