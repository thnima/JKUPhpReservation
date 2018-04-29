
<div class="table-responsive">
	<table class="table table-striped table-condensed">
		<tr>
			<th>Event</th>
			<th>Datum</th>
			<th>Ort</th>
			<?php
				if ($isAdmin) {
					echo '<th>Max. Teilnehmer</th>';
				}
			?>
			<th></th>
		</tr>

  	<?php
		$sql = "SELECT * FROM events ORDER by date";
		$result = mysqli_query($db, $sql);

		while ($row = mysqli_fetch_array($result)) {
			// DEAKTIVIERTE USER
			//if($row['extern']==1) {
			
			echo '<tr><td>';
			echo $row['title'];
			echo '</td>';
			
			echo '<td>';
			echo $row['date'];
			echo '</td>';
			
			echo '<td>';
			echo $row['location'];
			echo '</td>';

			if ($isAdmin) {
				echo '<td>';
				echo $row['maxMember'];
				echo '</td>';

				echo '<td>';
				echo '<a href="admin.php?event_id='.$row['id'].'">Infos/Bearbeiten</a>';
				echo '</td></tr>';
			}
			else {
				echo '<td>';
				echo '<a href="register.php?event_id='.$row['id'].'">Infos</a>';
				echo '</td></tr>';
			}
		}
  	?>
	</table>
</div>