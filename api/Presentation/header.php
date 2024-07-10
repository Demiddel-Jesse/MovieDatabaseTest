<?php

?>

<!DOCTYPE html>
<html lang="nl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Film bibliotheek</title>
  <script src="../user/api/js/script.js" defer></script>
  <link rel="stylesheet" href="../user/api/css/index.css">
</head>
<script>
  const fs = require('fs');
const path = require('path');
const directory = './';

// use readdir method to read the files of the direcoty 
fs.readdir(directory, (err, files) => {
  files.forEach(file => {
    // get the details of the file 
    let fileDetails = fs.lstatSync(path.resolve(directory, file));
    // check if the file is directory 
    if (fileDetails.isDirectory()) {
      console.log('Directory: ' + file);
    } else {
      console.log('File: ' + file);
    }
  });
});
</script>
<body>
  <nav class="c-nav">
    <ul class="c-nav__standard">
      <li><a href="index.php">Home</a></li>
      <?php
      if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
      ?>
        <li><a href="register.php">Register</a></li>
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
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="logout.php">logout</a></li>
      <?php
      }
      ?>
    </ul>
    <ul class="c-nav__admin">
      <?php
      if (isset($_SESSION['admin'])) {
      ?>
        <li><a href="addFilm.php">Add film to database</a></li>
        <!-- <li><a href="actorAdd.php">Add actor</a></li>
        <li><a href="directorAdd.php">Add director</a></li> -->
        <li><a href="categoryAdmin.php">Adjust Categories</a></li>
        <li><a href="genreAdmin.php">Adjust Genres</a></li>
      <?php
      }
      ?>
    </ul>
  </nav>