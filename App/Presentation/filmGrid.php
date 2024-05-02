<?php
?>
<section class="c-filmGrid">
  <?php
  foreach ($films as $film) {
    $film->setCoverImage(str_replace('~', '.', $film->getCoverImage()));
    $averageRating = $filmService->getAverageRating($film->getId());

    echo $twig->render('filmButton.twig', array('film' => $film, 'rating' => $averageRating));
  }

  ?>
</section>
<?php
