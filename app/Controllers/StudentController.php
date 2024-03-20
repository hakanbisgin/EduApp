<?php

namespace App\Controllers;

use App\Models\Student;

class StudentController extends CRUDController
{
    protected $modelClass = Student::class;


    public function store()
    {
        if (!empty($_POST['student_number']) && $this->model->whereFirst('student_number', $_POST['student_number'])) {
            addMessage("Student number already exists");
            back();
        }
        parent::store();

    }

    public function update($id)
    {
        if (!empty($_POST['student_number']) &&
            $this->model->where([
                ['student_number', '=', $_POST['student_number']],
                ['id', '!=', $id]
            ])) {
            addMessage("Student number already exists");
            back();
        }
        parent::update($id);
    }
}