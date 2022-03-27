<?php

use Fhooe\Router\Router;

$basePath = Router::getBasePath();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>fhooe/router-skeleton: GET /form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $basePath ?>/../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= $basePath ?>/../vendor/twbs/bootstrap-icons/font/bootstrap-icons.css">
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-lg">
            <a class="navbar-brand" href="<?= Router::urlFor("/") ?>">
                <img src="<?= $basePath ?>/../views/images/fhooe.svg" alt="" height="30"
                     class="d-inline-block align-text-top">
                fhooe/router-skeleton
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?= Router::urlFor("/form") ?>">
                            PHP Form
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Router::urlFor("/twigform") ?>">
                            Twig Form
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Router::urlFor("/staticpage") ?>">
                            Static HTML Page
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= Router::urlFor("/a/route/that/does/not/exist") ?>">
                            404 Page
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="container-lg mt-lg-4">
        <h2>GET /form</h2>
        <p>This is the view for the "GET /form" route, a simple PHP-based form.</p>
        <p>It submits to the "POST /form" route which is resolved through <code>Router::urlFor()</code>.
            The result is only shown, when <code>$_POST["nameInput"]</code> is present.</p>

        <?php
        if (isset($_POST["nameInput"])) {
            echo '<div class="alert alert-primary" role="alert">You successfully submitted this form! The result is shown below</div>';
        }
        ?>

        <div class="border p-3 mt-5">
            <h3>Example PHP Template Form</h3>
            <form method="post" action="<?= Router::urlFor("/form") ?>">
                <div class="mb-3">
                    <label for="nameInput" class="form-label">Your Name</label>
                    <input type="text" class="form-control" id="nameInput" name="nameInput"
                           placeholder="Your first or full name" aria-describedby="nameHelp" autocomplete="name"
                           required>
                    <div id="nameHelp" class="form-text">Please enter your name.</div>
                </div>
                <button type="submit" class="btn btn-primary">Send</button>
            </form>
        </div>

        <?php
        if (isset($_POST["nameInput"])) {
            ?>
            <div class="border p-3 mt-5">
                <h3>Example PHP Template Form Result</h3>
                <p>The submitted name is shown as the author of the wise quote below.</p>
                <figure class="p-3 m-0">
                    <blockquote class="blockquote">
                        <p>Lorem ipsum dolor sit amet.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        <?= $_POST["nameInput"] ?>
                    </figcaption>
                </figure>
            </div>
            <?php
        }
        ?>
    </div>
</main>

<div class="container-lg">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-lg-9 d-flex align-items-center">
            <img src="../views/images/fhooe.svg" alt="" height="24" class="me-2">
            <span class="text-muted">© FH Oberösterreich | Department of Digital Media</span>
        </div>

        <ul class="nav col-lg-3 justify-content-end list-unstyled d-flex">
            <li class="ms-3">
                <a class="text-muted" href="https://github.com/Digital-Media/fhooe-router-skeleton">
                    <i class="bi-github"></i>
                </a>
            </li>
        </ul>
    </footer>
</div>
<script src="<?= $basePath ?>/../vendor/twbs/bootstrap/dist/js/bootstrap.js"></script>
</body>
</html>
