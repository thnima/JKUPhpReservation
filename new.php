<?php
	// Konfiguration einbinden
	include_once "config.inc.php";

	// Datenbankverbindung aufbauen
	$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
	$db->set_charset("utf8");

	$currentPage = 'Admin';
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
  		<form action="admin.php?newEvent" method="POST">
			<div class="form-group row">
				<label for="eventTitle" class="col-sm-2 col-form-label">Eventname</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eventTitle" placeholder="Eventname" name="title" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="eventDate" class="col-sm-2 col-form-label">Datum</label>
				<div class="col-sm-10">
					<input type="datetime-local" class="form-control" id="eventDate" name="date" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="eventLocation" class="col-sm-2 col-form-label">Location</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eventLocation" placeholder="Location" name="location" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="eventMaxMember" class="col-sm-2 col-form-label">Max. Teilnehmer</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="eventMaxMember" placeholder="Maximale Anzahl der Teilnehmer" name="maxMember" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="eventDescription" class="col-sm-2 col-form-label">Beschreibung</label>
				<div class="col-sm-10">
					<textarea  rows="4" class="form-control" name="description" placeholder="Beschreibung" id="eventDescription"></textarea>
				</div>
			</div>


  			<button type="submit" class="btn btn-primary mt-3">Event erstellen</button>
  		</form>
	</div>
  </body>
</html>
