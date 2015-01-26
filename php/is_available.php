<?php
	// $date = $_GET['date'];
	// $tableNo = $_GET['table'];
	// echo "is_available.php erreicht.";
	// echo "$date";
	// echo "$tableNo";
	
	
	// Datenbankverbindung aufbauen
	require_once "db_config.php"; 

	$dbLink = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, MYSQL_PORT); 

	if(mysqli_connect_errno()) { 
		exit("Verbindungsaufbau fehlgeschlagen: %s\n" . mysqli_connect_error());
	} 
	if(!$dbLink->set_charset("utf8")){
		exit("Charset-Problem: " . $db_link->error);
	}
	
	// Verfügbarkeit prüfen
	
	$date = $_GET['date'];
	$tableNo = $_GET['table'];
	
	// $dateParts = explode('.', $date);
	// $mysqlDate = sprintf("%04d%02d%02d", $dateParts[2], $dateParts[1], $dateParts[0]);
	
	$isAvailable = true;
	$sql = "SELECT id FROM bookings WHERE date = $date AND table_no = $tableNo";
	
	if ($result = $dbLink->query($sql)) {
	
		$row_cnt = $result->num_rows;
		if ($row_cnt > 0) {
			$isAvailable = false;
			echo '<div class="alert alert-danger" role="alert">Tisch ' . $tableNo . ' ist am gew&uuml;nschten Datum leider nicht mehr verf&uuml;gbar.</div>';
		} else {
			echo '<div class="alert alert-info" role="alert">Tisch ' . $tableNo . ' ist verf&uuml;gbar.'; 
		}
		
		$result->close();
	}
	
	$dbLink->close();
	
	// echo "Das sollte jetzt im infoDiv stehen, wenn der Tisch verf&uuml;gbar ist.";

?>