<?php

declare(strict_types=1);

session_start();

require_once 'bootstrap.php';

use App\Business\UserListLineService;

$userListLineService = new UserListLineService();
if (isset($_COOKIE['user'])) {
  $user = unserialize($_COOKIE['user']);
} else if (isset($_COOKIE['admin'])) {
  $user = unserialize($_COOKIE['admin']);
} else {
  header('location: index.php');
  exit(0);
}

if (isset($_POST['action'])) {
  if ($_POST['action'] == 'newLine') {
    $userListLineService->createNewLine($user->getId(), intval($_POST['filmId']), 1);
  }
  if ($_POST['action'] == 'updateRating') {
    $userListLineService->updateRating($user->getId(), intval($_POST['filmId']), floatval($_POST['rating']) / 10);
  }
  if ($_POST['action'] == 'updateListType') {
    $userListLineService->updateList($user->getId(), intval($_POST['filmId']), intval($_POST['listTypeId']));
  }
}
