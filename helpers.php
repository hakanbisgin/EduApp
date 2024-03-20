<?php
function view(string $view, $data = []): void
{
    extract($data);
    $view = str_replace('.', '/', $view);
    include __DIR__ . '/app/Views/' . $view . '.php';
}

function env($key, $default = null)
{
    return $_ENV[$key] ?? $default;
}

function config(string $key)
{
    $keys = explode('.', $key);
    $config = require __DIR__ . '/config/' . $keys[0] . '.php';
    array_shift($keys);
    foreach ($keys as $key) {
        $config = $config[$key] ?? null;
    }
    return $config;
}

function redirect(string $path): void
{
    header("Location: $path");
    exit();
}

function back($default = '/'): void
{
    $back = $_SERVER['HTTP_REFERER'] ?? $default;
    if ($back === $_SERVER['REQUEST_URI']) {
        $back = $default;
    }
    header('Location: ' . $back);
    exit();
}

function authenticated(): bool
{
    return !empty($_SESSION['user']);
}

function dump(...$args): void
{
    echo '<pre>';
    var_dump(...$args);
    echo '</pre>';
}

function dd(...$args): void
{
    dump(...$args);
    die();
}

function getMessages(): array
{
    $messages = $_SESSION['messages'] ?? [];
    unset($_SESSION['messages']);
    return $messages;
}

function addMessage($message, $type = "error"): void
{
    $types = [
        'error' => 'alert-danger',
        'success' => 'alert-success',
        'info' => 'alert-info',
        'warning' => 'alert-warning'
    ];
    $_SESSION['messages'] [] = ['message' => $message, 'class' => $types[$type] ?? 'alert-warning'];
}

function countMessages(): int
{
    return count($_SESSION['messages'] ?? []);
}


