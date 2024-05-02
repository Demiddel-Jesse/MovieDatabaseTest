<?php

?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script src="./js/script.js" defer></script>
  <link rel="stylesheet" href="css/base.css">
</head>

<body>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <?php
      if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
      ?>
        <li><a href="login.php">Login</a></li>
      <?php
      }
      ?>
      <?php
      if (isset($_SESSION['admin']) || isset($_SESSION['user'])) {
        if (isset($_SESSION['admin'])) {
          $user = unserialize($_SESSION['admin']);
        } else if (isset($_SESSION['user'])) {
          $user = unserialize($_SESSION['user']);
        }
      ?>
        <li><a href="userPage.php?user=<?php echo $user->getId() ?>">Lists</a></li>
        <li><a href="logout.php">logout</a></li>
      <?php
      }
      ?>
      <?php
      if (isset($_SESSION['admin'])) {
      ?>
        <br>
        <li><a href="filmAdd.php">Add film</a></li>
        <!-- <li><a href="actorAdd.php">Add actor</a></li>
        <li><a href="directorAdd.php">Add director</a></li>
        <li><a href="categoryEdit.php">Edit Categories</a></li>
        <li><a href="genreEdit.php">Edit Genres</a></li> -->
      <?php
      }
      ?>
    </ul>
  </nav>