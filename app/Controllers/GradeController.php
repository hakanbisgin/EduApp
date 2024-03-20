<?php

namespace App\Controllers;

use App\Models\Course;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Term;

class GradeController extends CRUDController
{
    protected $viewPath = "grades";
    protected $modelClass = Grade::class;

    public function index()
    {
        $filters = [];
        foreach ($_GET as $key => $value) {
            if (!empty($value) && in_array($key, $this->model->attributes)) {
                $filters[$key] = $value;
            }
        }
        view("$this->viewPath.index",
            [
                'grades' => $this->model->all($filters),
                'attributes' => $this->model->attributes,
                'terms' => (new Term())->all(),
                'courses' => (new Course())->all(),
                'students' => (new Student())->all()
            ]);
    }

    public function create()
    {
        view("$this->viewPath.create",
            [
                'terms' => (new Term())->all(),
                'courses' => (new Course())->all(),
                'students' => (new Student())->all()
            ]);
    }

    public function show($id)
    {
        $grade = $this->model->find($id);
        view("$this->viewPath.show", ['grade' => $grade]);
    }

    public function edit($id)
    {
        $grade = $this->model->find($id);
        view("$this->viewPath.edit",
            [
                'grade' => $grade,
                'terms' => (new Term())->all(),
                'courses' => (new Course())->all(),
                'students' => (new Student())->all()
            ]);
    }

    public function getTranscript()
    {
        $filters = [];
        foreach ($_GET as $key => $value) {
            if (!empty($value) && in_array($key, $this->model->attributes)) {
                $filters[$key] = $value;
            }
        }
        $transcript = $this->model->getTranscript($filters);
        $total_weight = array_sum(array_column($transcript, 'weight'));
        $transcript = array_map(function ($item) use (&$total_weight) {

            $weighted_gpa = $item['grade'] * $item['weight'] / $total_weight;
            $item['gpa_total_weight_ratio'] = number_format($weighted_gpa, 2);
            return $item;
        }, $transcript);

        view("transcript.index",
            [
                'transcript' => $transcript,
                'tableAttributes' => [
                    'student',
                    'term',
                    'course',
                    'weight',
                    'grade'
                ],
                'terms' => (new Term())->all(),
                'courses' => (new Course())->all(),
                'students' => (new Student())->all()
            ]);
    }

}