<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\UserService;
use App\Exceptions\EmailInUseException;
use App\Exceptions\UsernameInUseException;

$userService = new UserService;

if (isset($_COOKIE['admin']) || isset($_COOKIE['user'])) {
  header('location: index.php');
  exit(0);
}

$error = '';

if (isset($_GET['action']) && $_GET['action'] == 'register') {
  if ($_POST['password'] == $_POST['password2']) {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      try {
        $userService->register($_POST['username'], $_POST['password'], $_POST['email']);
      } catch (EmailInUseException $th) {
        $error .= 'Email is already in use.<br>';
      } catch (UsernameInUseException $th) {
        $error .= 'Username is already in use.<br>';
      }
    } else {
      $error .= 'Geen correct email adres.<br>';
    }
  } else {
    $error .= 'Passwords do not match.<br>';
  }
}

include 'Presentation/header.php';

if ($error !== "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

include 'Presentation/registerForm.php';

include 'Presentation/footer.php';
