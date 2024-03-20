<?php

namespace App\Controllers;

use App\Models\Course;

class CourseController extends CRUDController
{
    protected $modelClass = Course::class;
}