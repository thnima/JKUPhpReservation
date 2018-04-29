<?php
	// Konfiguration einbinden
	include_once "config.inc.php";

	// Datenbankverbindung aufbauen
	$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
	$db->set_charset("utf8");


	if (isset($_GET['event_id'])) {
		$eventId = $_GET['event_id'];
	} 
	elseif (isset($_POST['id'])) {
		$eventId = $_POST['id'];
	}

	$currentPage = '';
?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title>Veranstaltungsservice</title>
  </head>
  <body>
  	<?php include('nav.php'); ?>

  	<div class="container mt-5">
  		<?php include('event.php'); ?>

		<div class="mt-5">


		<h5 class="mb-4">Anmeldung zum Event</h5>

  		<form action="register.php?event_id=<?php echo $eventId ?>" method="POST">
			<input type="hidden" name="id" value=<?php echo $eventId ?> />

			<div class="form-group row">
				<label for="firstName" class="col-sm-2 col-form-label">Vorname</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="firstName" name="firstName" required>
				</div>
			</div>
			<div class="form-group row">
				<label for="lastName" class="col-sm-2 col-form-label">Nachname</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="lastName" name="lastName" required>
				</div>
			</div>

			<h5 class="mb-4 mt-5">Begleitung (optional)</h5>
			<div class="form-group row">
				<label for="escortFirstName" class="col-sm-2 col-form-label">Vorname</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="escortFirstName" name="escortFirstName">
				</div>
			</div>
			<div class="form-group row">
				<label for="escortLastName" class="col-sm-2 col-form-label">Nachname</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="escortLastName" name="escortLastName">
				</div>
			</div>

			<?php 
				if(isset($_POST['id'])) {
					echo "<div class='mt-3 text-success'>Erfolgreich angemeldet!</div>";
					
					$sql = "INSERT INTO `participants` (`eventId`, `firstName`, `lastName`, `escortFirstName`, `escortLastName`) VALUES (".$_POST['id'].", '".$_POST['firstName']."', '".$_POST['lastName']."', '".$_POST['escortFirstName']."', '".$_POST['escortLastName']."');";
					//echo $sql;
					mysqli_query($db, $sql);
				}
			?>

  			<button type="submit" class="btn btn-primary mt-3">Anmelden</button>
  		</form>
		</div>
  	</div>
  </body>
</html>



