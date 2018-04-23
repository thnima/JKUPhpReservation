<?
// Konfiguration einbinden
include_once "config.inc.php";

// Datenbankverbindung aufbauen
$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
$db->set_charset("utf8");


echo '<link rel="stylesheet" type="text/css" href="style.css">';
echo '<h3><a href="index.php">Events</a> | <a href="admin.php">Admin</a></h3><br />';

if(isset($_GET['deleteId'])) {
	
	$sql="DELETE FROM `participants` WHERE `participants`.`id` = ".$_GET['deleteId'];
	mysqli_query($db, $sql);
	
	echo "Teilnehmer erfolgreich gelöscht!";
	die();
}

elseif(isset($_GET['newEvent'])) {
	
	
	// Neues Event in DB schreiben.
	if(isset($_POST['title'])) {
		echo "Neues Event erfolgreich angelegt!";
		
		$sql = "INSERT INTO `events` (`title`, `description`, `date`, `location`, `maxMember`) VALUES ('".$_POST['title']."', '".$_POST['description']."', '".$_POST['date']."', '".$_POST['location']."', ".$_POST['maxMember'].");";
		//echo $sql;
		mysqli_query($db, $sql);
		
		die();
	}
	else {
		echo '<form action="admin.php?newEvent" method="POST">';
		echo '<table>';
		echo '<tr><th>Event</th><th>Datum</th><th>Ort</th><th>max. Teilnehmer</th></tr>';
		echo '<tr><td><input type="text" name="title"></td><td><input type="datetime-local" name="date">
</td><td><input type="text" name="location"></td><td><input type="text" name="maxMember"></td></tr>';
		echo '<tr><th colspan="4">Beschreibung</th></tr>';
		echo '<tr><td colspan="4"><textarea  rows="8" cols="150" name="description"></textarea></td></tr>';
		echo '<tr><td colspan="4"><input type="submit" value="Neues Event erstellen" /></td></tr>';
		echo '</table></form>';
		
		
	}
}

elseif(isset($_GET['id'])) {
	
	$sql = "SELECT * FROM events WHERE id=".$_GET['id'];
	$result = mysqli_query($db, $sql);

	echo "Anmeldung zum folgenden Event:";

	echo '<table>';

	echo '<tr><th>Event</th><th>Datum</th><th>Ort</th><th>max. Teilnehmer</th></tr>';
	while ($row = mysqli_fetch_array($result)) {
		
		echo '<tr><td>';
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
		echo '</td></tr>';
		
		$id=$row['id'];
	}		

	echo '<table>';

	echo '<br /><br />';
	
	
	echo '<table>';
	echo '<tr><th>Vorname</th><th>Nachname</th><th>Begl. Vorname</th><th>Bgl. Nachname</th><th>x</th></tr>';
	
	
	$sql = "SELECT * FROM participants WHERE eventId=".$_GET['id'];
	$result = mysqli_query($db, $sql);
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
		echo '<a href="admin.php?deleteId='.$row['id'].'">löschen</a>';
		echo '</td></tr>';
		
		$id=$row['id'];
	}	
	
	echo '';
}

else {

	$sql = "SELECT * FROM events ORDER by date";
	$result = mysqli_query($db, $sql);

	echo '<table>';

	echo '<tr><th>Event</th><th>Datum</th><th>Ort</th><th>max. Teilnehmer</th><th>angem. Teilnehmer</th><th> </th></tr>';
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
		
		echo '<td>';
		echo $row['maxMember'];
		echo '</td>';
		
		echo '<td>';
		echo 'X';
		echo '</td>';
		
		echo '<td>';
		echo '<a href="admin.php?id='.$row['id'].'">Infos/Bearbeiten</a>';
		echo '</td></tr>';
	}		

	echo '</table>';
	
	echo '<br /><input type="button" class="button"  onclick="window.location.href=\'admin.php?newEvent=1\'" value="Neues Event erstellen" />';
}
	
?>