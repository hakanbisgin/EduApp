<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="/js/app.js"></script>

    <title>
        <?= $title ?? ucfirst(ltrim(str_replace("/", " ", $_SERVER["REQUEST_URI"]) . " @ " . config('app.name'), " ")) ?>
    </title>
</head>
<body>
<div class="container-fluid px-2 pb-5" style="min-height: 94dvh">
    <nav class="navbar navbar-light bg-light d-flex justify-content-between px-5  mb-5" style="margin-inline: -0.5rem">
        <a class="navbar-brand" href="/"><?= config('app.name') ?></a>
        <div class="navbar-nav d-flex flex-row flex-wrap gap-2">
            <?php if (authenticated()): ?>
                <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/students') ? "text-primary" : "" ?>"
                   href="/students">Students</a>
                <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/courses') ? "text-primary" : "" ?>"
                   href="/courses">Courses</a>
                <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/grades') ? "text-primary" : "" ?>"
                   href="/grades">Grades</a>
                <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/transcripts') ? "text-primary" : "" ?>"
                   href="/transcripts">Transcript</a>
                <a class="nav-link <?= str_contains($_SERVER['REQUEST_URI'], '/terms') ? "text-primary" : "" ?>"
                   href="/terms">Terms</a>
                <a class="nav-link disabled"
                   href="#"><?= $_SESSION['user']['name'] . " " . $_SESSION['user']['surname'] ?></a>
                <form action="/logout" method="post">
                    <button type="submit" class="nav-link text-danger">
                        Logout
                    </button>
                </form>
            <?php else: ?>
                <a class="nav-link" href="/register">Register</a>
                <a class="nav-link" href="/login">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <?php foreach (getMessages() as $message): ?>
    <div class="alert <?= $message['class'] ?>">
        <?= $message["message"]; ?>
    </div>
<?php endforeach; ?>