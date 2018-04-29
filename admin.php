<?php
	// Konfiguration einbinden
	include_once "config.inc.php";

	// Datenbankverbindung aufbauen
	$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
	$db->set_charset("utf8");

	$currentPage = 'Admin';
	$isAdmin = true;


	if(isset($_GET['deleteId'])) {
		$sql="DELETE FROM `participants` WHERE `participants`.`id` = ".$_GET['deleteId'];
		mysqli_query($db, $sql);
	}
?>


<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Veranstaltungsservice</title>
  </head>
  <body>
  	<?php include('nav.php'); ?>

  	<div class="container mt-5">
	  	<?php
			// Neues Event in DB schreiben.
			if(isset($_POST['title']) && isset($_POST['date']) && isset($_POST['location'])) {
				$sql = "INSERT INTO `events` (`title`, `description`, `date`, `location`, `maxMember`) VALUES ('".$_POST['title']."', '".$_POST['description']."', '".$_POST['date']."', '".$_POST['location']."', ".$_POST['maxMember'].");";
				//echo $sql;
				mysqli_query($db, $sql);

				echo "<div class='text-success mb-3'>Neues Event erfolgreich angelegt!</div>";
			}

			if(isset($_GET['event_id'])) {

  				include('event.php');
				
				
				echo "<h3 class='mt-5 mb-3'>Anmeldungen zum Event</h3>";
				
				
				$sql = "SELECT * FROM participants WHERE eventId=".$_GET['event_id'];
				$result = mysqli_query($db, $sql);

				if ($result->num_rows != 0) {

					echo '<div class="table-responsive">';
					echo '<table class="table table-striped table-condensed">';
					echo '<tr><th>Vorname</th><th>Nachname</th><th>Begl. Vorname</th><th>Bgl. Nachname</th><th> </th></tr>';

					while ($row = mysqli_fetch_array($result)) {
						
						echo '<tr><td>';
						echo $row['firstName'];
						echo '</td>';
						
						echo '<td>';
						echo $row['lastName'];
						echo '</td>';
						
						echo '<td>';
						echo $row['escortFirstName'];
						echo '</td>';
						
						echo '<td>';
						echo $row['escortLastName'];
						echo '</td>';
						
						echo '<td>';
						echo '<a href="admin.php?deleteId='.$row['id'].'&event_id='.$_GET['event_id'].'">löschen</a>';
						echo '</td></tr>';
						
						$id=$row['id'];
					}	
					echo '</table>';
					echo '</div>';



					if(isset($_GET['deleteId'])) {
						echo "<div class='text-danger'>Teilnehmer erfolgreich gelöscht!</div>";
					}
				} else{
					echo 'Keine Anmeldungen zur Zeit';
				}
				
				echo '';
			}
			
			echo '<br />';

			if(!isset($_GET['event_id'])) {
  				include('event-table.php');
			}

				
			?>

	  		<a class="btn btn-primary mt-4 mb-5" href="new.php">Neues Event erstellen</a>
		</div>
  </body>
</html>