<!DOCTYPE html>

<html lang="de">

<head>
	
	<title>Reservierung</title>
	
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
	
	// Variable, um dynamische Ausgabe zu realieren.
	$booked = null;
	
	// Überprüfung der Captcha-Eingabe
    if (verifyCaptcha()) {
	
		// Überprüfung der POST-Parameter
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
			
			$bookingNo = uniqid();
			
			// Überprüfung der Verfügbarkeit des Tisches
			if (isAvailable($dbLink, $mysqlDate, $tableNo)) {
			
				$sql="INSERT INTO bookings(booking_no, date, time, table_no, persons, first_name, last_name, email, phone) 
					  VALUES ('$bookingNo', '$mysqlDate', '$time', '$tableNo', '$persons', '$firstName', '$lastName', '$email', '$phone')";
			
				if (!$dbLink->query($sql)) {
					exit('Fehler beim Insert' . $dbLink->error);
					$dbLink->close();
				} else {
				
					// Datensatz wurde in DB eingefügt.
					$booked = "booked";
					
					// Hier könnte man noch eine Mail versenden. Der Code dafür ist recht simpel, 
					// allerdings braucht man dafür natürlich einen Mailserver.
					
					// $empfaenger = $email;
					// $betreff = "Ihre Reservierung";
					// $text = "Ihre Reservierung wurde entgegengenommen.";
					// mail($empfaenger, $betreff, $text);
					
					$dbLink->close();
				}
			} else {
				$booked = "not_available";
			}
		} else {
			$booked = "post_error";
		}
	} else {
		$booked = "captcha_error";
	}
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
                <li role="presentation"><a href="kontakt.php">Kontakt</a>
                </li>
                <li role="presentation"><a href="impressum.php">Impressum</a>
                </li>
            </ul>
        </div>

    </div>

    <div class="content" id="content">

        <div class="intro">
			
			<?php
	
				if ($booked == "booked") {
					// Datensatz wurde in die DB geschrieben -> Erfolgsmeldung an Benutzer
					echo "<h3>Ihre Reservierung wurde erfasst. Vielen Dank.</h3>";
					echo "<h4>Reservierungsnummer: $bookingNo</h4>";
					echo "<p>Bitte notieren Sie sich diese Reservierungsnummer für eventuelle Rückfragen.</p>";
					echo "<p>Sie haben den Tisch $tableNo für den $date um $time Uhr reserviert.</p>";
				} elseif ($booked == "not_available") {
					// Reservierung nicht möglich: Tisch nicht verfügbar
					echo "<h3>Der von Ihnen gew&auml;hlte Tisch Nr. $tableNo ist am $date leider nicht mehr verf&uuml;gbar.</h3>";
				} elseif ($booked == "post_error") {
					// Reservierung nicht möglich: POST-Parameter falsch
					echo "<h3>Reservierung fehlgeschlagen: &Uuml;bermittelte Formularinhalte korrupt.</h3>";
				} elseif ($booked == "captcha_error") {
					// Reservierung nicht möglich: Captcha-Fehler
					echo "<h3>Reservierung fehlgeschlagen: Bitte best&auml;tigen Sie, dass Sie kein Roboter sind.</h3>";
				}
	
			?> 
			
			<p><a href="reservierung.php" />Zur&uuml;ck zum Reservierungsformular</p>
            
        </div>

    </div>
	
</body>

</html>