<!DOCTYPE html>

<html lang="de">

<head>
	
	<title>Best&auml;tigung</title>
	
	<!-- Imports ---------------------->
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>

    <!-- jQuery -->
    <script src="js/jquery-1.11.1.js"></script>

    <!-- Sticky Header -->
    <script src="js/sticky.js"></script>

    <!-- Bootstrap CSS-->
    <link href="css/bootstrap.css" rel="stylesheet">


    <!-- Styles ---------------------->
    <style type="text/css">
        a {
            / word-wrap: break-word;
        }
        .header {
            padding-top: 15px;
            height: 50px;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
        }
        .navigation {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 100;
            border-top: 0;
        }
        .content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
	
</head>

<?php
	include "php/functions.php";
	
	// Boolsche Variable, um dynamische Ausgabe zu realieren.
	$booked = false;
	
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
				
					// Datensatz wurde in DB eingefügt.
					$booked = true;
					
					// Hier könnte man noch eine Mail versenden. Der Code dafür ist recht simpel, 
					// allerdings braucht man dafür natürlich einen Mailserver.
					
					// $empfaenger = $email;
					// $betreff = "Ihre Reservierung";
					// $text = "Ihre Reservierung wurde entgegengenommen.";
					// mail($empfaenger, $betreff, $text);
					
					mysqli_close($dbLink);
				}
			}
		} else {
			echo "Eingabefehler";
		}
	// }
?> 

<body>

    <div>
        <img src="images/restaurant2.jpg" width="100%">
    </div>

    <div id="pageHeader" class="header">

        <div class="navigation">
            <ul class="nav nav-tabs" style="background-color:white;">
                <li role="presentation"><a href="index.html">Start</a>
                </li>
                <li role="presentation" class="active"><a href="reservierung.php">Reservierung</a>
                </li>
                <li role="presentation"><a href="#">Kontakt</a>
                </li>
                <li role="presentation"><a href="#">Impressum</a>
                </li>
            </ul>
        </div>

    </div>

    <div class="content" id="content">

        <div class="intro">
			
			<?php
	
				if ($booked) {
					// Datensatz wurde in die DB geschrieben -> Erfolgsmeldung an Benutzer
					echo "<h3>Ihre Reservierung wurde erfasst. Vielen Dank.</h3>";
					echo "<p>Reservierungsnummer: $bookingNo<br />"
					     . "Reservierungsdatum: $date, $time<br />"
					     . "Tisch-Nr: $tableNo</p>";
				} else {
					// Reservierung war nicht möglich -> entsprechende Meldung an Benutzer
					echo "<h3>Der von Ihnen gew&auml;hlte Tisch Nr. $tableNo ist am $date leider nicht mehr verf&uuml;gbar.</h3>";
				}
	
			?>
			
			<p><a href="reservierung.php" />Zur&uuml;ck zum Reservierungsformular</p>
            
        </div>

    </div>
	
</body>

</html>