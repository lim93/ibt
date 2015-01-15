<!DOCTYPE html>

<html lang="de">

<?php
	include "php/functions.php";
	
	// Überprüfung der Captcha-Eingabe; liefert im Moment immer true zurück.
    //if (verifyCaptcha()) {
	
		if (checkPostParams()) {
		
			$dbLink = getDbLink();
		
			$date = mysqli_real_escape_string($dbLink, $_POST['date']);
			$time = mysqli_real_escape_string($dbLink, $_POST['time']);
			$tableNo = mysqli_real_escape_string($dbLink, $_POST['table_no']);
			$persons = mysqli_real_escape_string($dbLink, $_POST['persons']);
			$firstName = mysqli_real_escape_string($dbLink, $_POST['first_name']);
			$lastName = mysqli_real_escape_string($dbLink, $_POST['last_name']);
			$email = mysqli_real_escape_string($dbLink, $_POST['email']);
			$phone = mysqli_real_escape_string($dbLink, $_POST['phone']);
			
			$dateParts = explode('.', $date);
			$mysqlDate = sprintf("%04d%02d%02d", $dateParts[2], $dateParts[1], $dateParts[0]);
			
			$bookingNo = 42;
			
			if (isAvailable($dbLink, $mysqlDate, $tableNo)) {
			
				$sql="INSERT INTO bookings(booking_no, date, time, table_no, persons, first_name, last_name, email, phone) 
					  VALUES ('$bookingNo', '$mysqlDate', '$time', '$tableNo', '$persons', '$firstName', '$lastName', '$email', '$phone')";
			
				if (!$dbLink->query($sql)) {
					exit('Fehler beim Insert' . mysqli_error($dbLink));
					mysqli_close($dbLink);
				} else {
					// Hier könnte man noch eine Mail versenden. Der Code dafür ist recht simpel, 
					// allerdings braut man dafür natürlich einen Mailserver.
					
					// $empfaenger = $email;
					// $betreff = "Ihre Reservierung";
					// $text = "Ihre Reservierung wurde entgegengenommen.";
					// mail($empfaenger, $betreff, $text);
					
					mysqli_close($dbLink);
				}
			} else {
			
				// Dem Benutzer irgendwie Bescheid sagen, dass seine Reservierung nicht möglich war.
				echo "Keine Reservierung möglich: Tisch $tableNo am $date schon reserviert.";
				
			}
		} else {
			echo "Eingabefehler";
		}
	// }
?>

<head>
	<title>Best&auml;tigung</title>
</head>

<body>

    <p>Ihre Reservierung wurde erfasst. Vielen Dank.</p>

<?php
    echo "Reservierungsdatum: " . $date . ", " . $time . "<br />";
	echo "Tisch-Nr: " . $tableNo;
?> 

    <p><a href="reservierung.php" />Zur&uuml;ck zum Reservierungsformular</p>

</body>