<?php

namespace App\Models;

class Student extends Model
{
    public $name = 'student';
    public $table = 'students';
    public $attributes = ['name', 'surname', 'student_number'];
}
