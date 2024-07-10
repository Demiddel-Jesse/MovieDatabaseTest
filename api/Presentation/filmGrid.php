<?php
?>
<search>
  <form action="index.php?action=search" method="get">
    <label>Find a Movie
      <input type="search" id="searchName" name="searchName" value="<?php echo $searchValue ?>" />
    </label>
    <button type="submit">Search</button>
  </form>
</search>

<section class="c-filmGrid">
  <?php
  foreach ($films as $film) {
    $film->setCoverImage(str_replace('~', './api', $film->getCoverImage()));
    $averageRating = $filmService->getAverageRating($film->getId());

    echo $twig->render('filmButton.twig', array('film' => $film, 'rating' => $averageRating));
  }
  ?>
</section>
<?php
