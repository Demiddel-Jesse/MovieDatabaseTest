<?php

declare(strict_types=1);

session_start();

unset($_SESSION["admin"]);
unset($_SESSION["user"]);
header('location: index.php');
exit(0);
