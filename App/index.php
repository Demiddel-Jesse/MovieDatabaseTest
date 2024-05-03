<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;

$filmService = new FilmService();
$films = $filmService->getAllFilms();

// TODO: register system for users
// TODO: dashboard for users
// TODO: list page for users
// TODO: add and update categories/genres

include 'Presentation/header.php';

include 'Presentation/filmGrid.php';

include 'Presentation/footer.php';
