<?
// Konfiguration einbinden
include_once "config.inc.php";

// Datenbankverbindung aufbauen
$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
$db->set_charset("utf8");

echo '<link rel="stylesheet" type="text/css" href="style.css">';
echo '<h3><a href="index.php">Events</a> | <a href="admin.php">Admin</a></h3><br />';

if(isset($_POST['id'])) {
	echo "Erfolgreich angemeldet!";
	
	$sql = "INSERT INTO `participants` (`eventId`, `firstName`, `lastName`, `escortFirstName`, `escortLastName`) VALUES (".$_POST['id'].", '".$_POST['firstName']."', '".$_POST['lastName']."', '".$_POST['escortFirstName']."', '".$_POST['escortLastName']."');";
	//echo $sql;
	mysqli_query($db, $sql);
	
	die();
}


$sql = "SELECT * FROM events WHERE id=".$_GET['id'];
$result = mysqli_query($db, $sql);


echo '<table><tr>';
echo '<tr><th>Event</th><th>Datum</th><th>Ort</th><th>max. Teilnehmer</th></tr>';
while ($row = mysqli_fetch_array($result)) {
	// DEAKTIVIERTE USER
	//if($row['extern']==1) {
	
	echo '<td>';
	echo $row['title'];
	echo '</td>';
	
	echo '<td>';
	echo $row['date'];
	echo '</td>';
	
	echo '<td>';
	echo $row['location'];
	echo '</td>';
	
	echo '<td>';
	echo $row['maxMember'];
	echo '</td>';
	
	echo '<tr><td colspan="4">';
	echo $row['description'];
	echo '</td></tr>';
	
	$id=$row['id'];
}		

echo '<table><tr>';

echo '<br /><br />';


echo "<h3>Anmeldung zum Event</h3>";
echo '<form action="register.php" method="POST">
<input type="hidden" name="id" value="'.$id.'" />
<table><tr><th colspan="2">Teilnehmer</th><th colspan="2">Begleitung (optional ;-)</th></tr>
<tr><td>Vorname</td><td>Nachname</td><td>Vorname</td><td>Nachname</td></tr>
<tr><td><input type="text" name="firstName"></td><td><input type="text" name="lastName"></td><td><input type="text" name="escortFirstName"></td><td><input type="text" name="escortLastName"></td></tr>
<tr><th colspan="4"><input type="submit" value="Anmelden"></th></tr>
</form>';

	
?>