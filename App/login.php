<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\UserService;
use App\Exceptions\DoesntExistException;
use App\Exceptions\PasswordIncorrectException;

$error = '';

if (isset($_GET['action']) && $_GET['action'] = 'login') {
  $userService = new UserService();

  if (!empty($_POST['username'])) {
    $username = $_POST['username'];
  } else {
    $error .= "Gebruikersnaam niet ingevuld.<br>";
  }

  if (!empty($_POST['password'])) {
    $password = $_POST['password'];
  } else {
    $error .= "Wachtwoord niet ingevuld.<br>";
  }

  if ($error == '') {
    try {
      $user = $userService->login($username, $password);
      if ($user->getAdmin() == 1) {
        setcookie("admin", serialize($user), time() + 1 * 30 * 24 * 3600, "/");
        $_COOKIE['admin'] = serialize($user);
      } else {
        setcookie("user", serialize($user), time() + 1 * 30 * 24 * 3600, "/");

        $_COOKIE['user'] = serialize($user);
      }
      header('location: index.php');
      exit(0);
    } catch (DoesntExistException $th) {
      $error .= "Admin bestaat niet.<br>";
    } catch (PasswordIncorrectException $th) {
      $error .= "Wachtwoord is verkeerd.<br>";
    }
  }
}

include 'Presentation/header.php';

if ($error !== "") {
  echo "<span style=\"color:red;\">" . $error . "</span>";
}

$url = htmlentities($_SERVER["PHP_SELF"]);
print $twig->render("loginForm.twig", array('url' => $url));

include 'Presentation/footer.php';
