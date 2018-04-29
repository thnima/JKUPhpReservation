<?php
	if (isset($_GET['event_id'])) {
		$sql = "SELECT * FROM events WHERE id=".$_GET['event_id'];
		$result = mysqli_query($db, $sql);

		while ($row = mysqli_fetch_array($result)) {
			echo '<h2>'.$row['title'].'</h2>';

			echo '<div class="row">';
			echo '<div class="col-md-6">Datum</div>';
			echo '<div class="col-md-6">'.$row['date'].'</div>';
			echo '</div>';


			echo '<div class="row">';
			echo '<div class="col-md-6">Ort</div>';
			echo '<div class="col-md-6">'.$row['location'].'</div>';
			echo '</div>';

			echo '<div class="row">';
			echo '<div class="col-md-6">Beschreibung</div>';
			echo '<div class="col-md-6">'.$row['description'].'</div>';
			echo '</div>';

			echo '<div class="row">';
			echo '<div class="col-md-6">Max. Teilnehmer</div>';
			echo '<div class="col-md-6">'.$row['maxMember'].'</div>';
			echo '</div>';
		}
	}
?>