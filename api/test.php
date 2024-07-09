<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use api\Business\FilmService;

$filmService = new FilmService();
$films = $filmService->getAllFilms();

include 'Presentation/header.php';

include 'Presentation/filmGrid.php';

include 'Presentation/footer.php';
