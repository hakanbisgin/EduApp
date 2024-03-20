<?php

require_once __DIR__ . '/../vendor/autoload.php';

set_exception_handler(function (Throwable $exception)
{
    $file = __DIR__ . '/../logs/app.log';
    if (!file_exists($file)){
        fopen($file, 'w');
    }
    error_log(  date('Y-m-d H:i:s') . " " .
        $exception->getMessage() . " in " . $exception->getFile() .
        " on line " . $exception->getLine() . "\n" . $exception->getTraceAsString() . "\n",
        3, __DIR__ . '/../logs/app.log');
    view('errors.500');
});

use App\Controllers\AuthController;
use App\Controllers\CourseController;
use App\Controllers\GradeController;
use App\Controllers\HomeController;
use App\Controllers\StudentController;
use App\Controllers\TermController;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();


session_start();

$router = new \App\Router();

$router->get('/', HomeController::class, 'index');
$router->get('/login', AuthController::class, 'showLogin');
$router->post('/login', AuthController::class, 'login');
$router->get('/register', AuthController::class, 'showRegister');
$router->post('/register', AuthController::class, 'register');
$router->post('/logout', AuthController::class, 'logout');

if (authenticated()) {
    $router->resource('/students', StudentController::class);
    $router->resource('/courses', CourseController::class);
    $router->resource('/terms', TermController::class);
    $router->resource('/grades', GradeController::class);
    $router->get('/transcripts', GradeController::class, 'getTranscript');
}

$router->dispatch();


