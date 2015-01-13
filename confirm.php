<!DOCTYPE html>

<html lang="de">

<?php
    require_once( 'php/db_config.php'); 

	$db_link = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, MYSQL_PORT); 

	if(mysqli_connect_errno()) { 
		exit("Verbindungsaufbau fehlgeschlagen: " . mysqli_connect_error());
	} 
	if(!$db_link->set_charset("utf8")){
		exit("Charset-Problem: " . $db_link->error);
	} 
	
    $booking_no = 42;
	
	if ( isset($_POST['date']) and isset($_POST['time']) and isset($_POST['table_no']) and isset($_POST['persons'])
        and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) and isset($_POST['phone'])
        and $_POST['date'] != "" and $_POST['time'] != "" and $_POST['table_no'] != "" and $_POST['persons'] != ""
        and $_POST['first_name'] !=  "" and $_POST['last_name'] != "" and $_POST['email'] != "" and $_POST['phone'] != "" ) 
	{
	    $date = mysqli_real_escape_string($db_link, $_POST['date']);
	    $time = mysqli_real_escape_string($db_link, $_POST['time']);
	    $table_no = mysqli_real_escape_string($db_link, $_POST['table_no']);
	    $persons = mysqli_real_escape_string($db_link, $_POST['persons']);
	    $first_name = mysqli_real_escape_string($db_link, $_POST['first_name']);
	    $last_name = mysqli_real_escape_string($db_link, $_POST['last_name']);
	    $email = mysqli_real_escape_string($db_link, $_POST['email']);
	    $phone = mysqli_real_escape_string($db_link, $_POST['phone']);
		
		$date_parts = explode('.', $date);
		$mysql_date = sprintf("%04d-%02d-%02d", $date_parts[2], $date_parts[1], $date_parts[0]);

        $sql="INSERT INTO bookings(booking_no, date, time, table_no, persons, first_name, last_name, email, phone) 
	          VALUES ('$booking_no', '$mysql_date', '$time', '$table_no', '$persons', '$first_name', '$last_name', '$email', '$phone')";
    
        if (!$db_link->query($sql)) {
	        exit('Fehler beim Insert' . mysqli_error($db_link));
	    }
    } else {
        echo "Eingabefehler";
	}
?>

<head>
	<title>Bestätigung</title>
</head>

<body>

    <p>Ihre Reservierung wurde erfasst. Vielen Dank.</p>

<?php
    echo "Reservierungsdatum: " . $date . ", " . $time . "\n";
	echo "Tisch-Nr: " . $table_no;
?> 

    <p><a href="http://localhost/ibt/reservierung.php" />Zurück zum Reservierungsformular</p>

</body>