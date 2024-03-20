<?php

namespace App\Controllers;

use App\Models\Term;

class TermController extends CRUDController
{
    protected $modelClass = Term::class;
}