<?php

?>
<h1>Edit <?php echo $type ?> </h1>

<h2>adjust <?php echo $type ?></h2>

<form action="<?php echo $type ?>Service.php?action=adjust" method="post">
  <label>
    select <?php echo $type ?>
    <select name="<?php echo $type ?>" id="<?php echo $type ?>">
      <?php
      foreach ($list as $thing) {
      ?>
        <option value="<?php echo $thing->getId() ?>">
          <?php echo $thing->getName() ?>
        </option>
      <?php
      }
      ?>
    </select>
  </label>
  <br><br>
  <label>new name: <input type="text" name="name" id="name"></label>
  <br><br>
  <button type="submit">submit</button>
</form>

<h2>Add new <?php echo $type ?></h2>
<form action="<?php echo $type ?>Service.php?action=add" method="post">
  <label>name: <input type="text" name="name" id="name"></label>
  <br><br>
  <button type="submit">submit</button>
</form>