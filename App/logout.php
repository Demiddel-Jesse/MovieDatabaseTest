<?php

declare(strict_types=1);

session_start();

// unset($_COOKIE["admin"]);
// unset($_COOKIE["user"]);
setcookie("admin", "", time()-3600);
setcookie("user", "", time()-3600);
header('location: index.php');
exit(0);
