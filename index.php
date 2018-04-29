<?php
	// Konfiguration einbinden
	include_once "config.inc.php";

	// Datenbankverbindung aufbauen
	$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
	$db->set_charset("utf8");

	$currentPage = 'Events';
	$isAdmin = false;
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
  		<?php include('event-table.php'); ?>
  	</div>
  </body>
</html>
