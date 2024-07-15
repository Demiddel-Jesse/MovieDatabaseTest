<?php

declare(strict_types=1);

session_start();

unset($_COOKIE["admin"]);
unset($_COOKIE["user"]);
header('location: index.php');
exit(0);
