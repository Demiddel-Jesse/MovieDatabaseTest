<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\FilmService;

$filmService = new FilmService();
$films = $filmService->getAllFilms();

// TODO: add and update categories/genres

include 'Presentation/header.php';

include 'Presentation/filmGrid.php';

include 'Presentation/footer.php';
