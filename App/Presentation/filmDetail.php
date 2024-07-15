<?php

if (isset($_COOKIE['admin'])) {
?>
	<a href="editFilm.php?film=<?php echo $film->getId() ?>">Edit film</a>
<?php
}

?>
<div class="detailWrapper">
	<section class="c-filmDetail js-filmDetailCheck">
		<h1><?php echo $film->getTitle(); ?></h1>
		<img src="<?php echo $film->getCoverImage(); ?>" alt="<?php echo $film->getTitle(); ?> Poster" />
		<?php
		if ($film->getRuntime() != null) {
		?>
			<p>runtime: <?php echo $film->getRuntime(); ?> min</p>
		<?php
		}
		if ($film->getGenreId() != null) {
		?>
			<p>genre: <?php echo $genreService->getGenre($film->getGenreId())->getName() ?></p>
		<?php
		}
		?>
		<p>Average rating: <?php echo $averageRating; ?>/10</p>
		<?php
		if ($film->getDescription() != null) {
		?>
			<p><?php echo $film->getDescription() ?></p>
		<?php
		}
		?>
	</section>
	<?php
	if (isset($_COOKIE['admin']) || isset($_COOKIE['user'])) {
		$userListLine = $userListLineService->getUserListLine($user->getId(), $_GET['film']);
	?>
		<button class="js-buttonAddToUserLists" data-filmId="<?php echo $film->getId(); ?>" <?php echo $userListLine == null ? '' : 'hidden' ?>>Add to your lists</button>
		<section class="js-personalRatingCheck c-personalRatingForm" <?php echo $userListLine == null ? 'hidden' : '' ?>>
			<h2>Your rating</h2>
			<form action="detail.php?action=userList&film=<?php echo $film->getId() ?>" method="post">
				<?php
				if ($userListLine != null) {
					$userListLineListId = $userListLine->getListTypeId();
					$userRating = $userListLine->getRating() * 10;
				} else {
					$userListLineListId = 0;
					$userRating = 0;
				}
				?>
				<label>
					Your rating <br>
					<input type="range" list="ratingValues" min="0" max="100" step="5" id="ratingValue" name="ratingValue" value="<?php echo $userRating ?>" class="js-currentRatingInput" data-filmId="<?php echo $film->getId(); ?>" />
				</label>
				<span class="js-currentRatingDisplay"></span>
				<br>
				<label>
					List <br>
					<select name="listTypeId" id="listTypeId" class="js-listTypeSelect" data-filmId="<?php echo $film->getId(); ?>">
						<option value="NULL" <?php echo $userListLine == null ? 'selected' : '' ?>>Not in your list</option>

						<?php
						$listTypes = $listTypeService->getAllListTypes();

						foreach ($listTypes as $listType) {
							if ($listType->getId() == $userListLineListId) {
								$selected = 'selected';
							} else {
								$selected = '';
							}
						?>
							<option value="<?php echo $listType->getId() ?>" <?php echo $selected ?>><?php echo $listType->getName() ?></option>
						<?php
						}
						?>
					</select>
				</label>
				<br><br>
				<button type="submit" class="js-personalRatingFormButton">Save</button>
			</form>
		</section>
	<?php
	}
	?>
</div>