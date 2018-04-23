<?
// Konfiguration einbinden
include_once "config.inc.php";

// Datenbankverbindung aufbauen
$db = mysqli_connect(Config::DB_SERVER, Config::DB_USER, Config::DB_PASSWORD, Config::DB_NAME);
$db->set_charset("utf8");


echo '<link rel="stylesheet" type="text/css" href="style.css">';

$sql = "SELECT * FROM events ORDER by date";
$result = mysqli_query($db, $sql);

echo '<h3><a href="index.php">Events</a> | <a href="admin.php">Admin</a></h3><br />';
echo '<table>';

echo '<tr><th>Event</th><th>Datum</th><th>Ort</th><th>max. Teilnehmer</th><th> </th></tr>';
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
	echo '<a href="register.php?id='.$row['id'].'">Infos</a>';
	echo '</td></tr>';
}		

echo '</table>';
	
?>