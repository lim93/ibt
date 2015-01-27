// Formularinhalte validieren
function validateForm() {

    var isValid = true;
    var errorMessage = "";

    var date = $('#date').val();
    var time = $('#time').val();
    var tableNo = $('#table_no').val();
    var lastName = $('#last_name').val();
    var email = $('#email').val();
	var captcha = $('#g-recaptcha-response').val();
	
	// Leerzeichen am Anfang und am Ende des Strings entfernen.
	lastName = lastName.replace(/^\s+/g, '').replace(/\s+$/g, '');
	
    // Datumsvalidierung
	errorMessage += checkDate(date);

    // Uhrzeitvalidierung
	errorMessage += checkTime(time);

    // Tischnummer validieren
	errorMessage += checkTableNo(tableNo);

    // Nachname validieren
	errorMessage += checkLastName(lastName);

    // E-Mailvalidierung
	errorMessage += checkEmail(email);

	// Captcha-Validierung
	errorMessage += checkCaptcha(captcha);
	
	// Fehlermeldungen ausgeben, falls vorhanden
    if (errorMessage.length > 0) {
        isValid = false;
        showErrorMsg(errorMessage);
    }
	
    return isValid;
}

// Fehlermeldungen ausgeben
function showErrorMsg(message) {
    $("#errorDiv").html('<div class="alert alert-danger" role="alert">' + message + '</div>');
}

// Prüfen, ob Tisch am gewählten Datum verfügbar ist
function isAvailable(date, tableNo) {
	
	// var date = $('#date').val();
	// var tableNo = $('#table_no').val();
	var errorMessage = "";
	
	// Info-Nachricht löschen, falls eins der beiden Felder leer ist.
	if (date == "" || tableNo == "") {
		$("#infoDiv").html("");
		return;
	} else {
		
		// Datum und Tischnummer auf korrekte Eingabe überprüfen.
		errorMessage += checkDate(date);
		errorMessage += checkTableNo(tableNo);
		
		if (errorMessage === "") {
			
			// Datum in MySQL-verständlichen String umwandeln.
			var dateParts = date.split(".");
			var mysqlDate = "" + dateParts[2] + dateParts[1] + dateParts[0];
			
			// XML HTTP Request erzeugen und an is_available.php schicken.
			if (window.XMLHttpRequest) { // Chrome, Firefox, Safari, Opera, IE10+
				xmlhttp = new XMLHttpRequest();
			} else { // IE9-
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					$("#infoDiv").html(xmlhttp.responseText);
				}
			}
			xmlhttp.open("GET","php/is_available.php?date="+mysqlDate+"&table="+tableNo,true);
			xmlhttp.send();
		}
	}
}

// Datumsvalidierung
function checkDate(date) {
	
	var errorMessage = "";
	
    // Datumsfeld darf nicht leer sein
    if (date === "") {
        errorMessage = "Bitte geben Sie ein Datum an.<br />";
    } else {

        // Datum muss folgendem Format entsprechen: dd.mm.yyyy
        var dateRegex = new RegExp(
            "^(0?[1-9]|[12][0-9]|3[01])\\.(0?[1-9]|1[0-2])\\.(19|20)\\d\\d$");

        if (!dateRegex.test(date)) {

            errorMessage = "Das angegebene Datum entspricht nicht dem g&uuml;ltigen Format (tt.mm.jjjj).<br />";
        } else {

            // Datum muss gültig sein (30.02. etc. ausschließen)
            var comp = date.split('.');
            var d = parseInt(comp[0], 10);
            var m = parseInt(comp[1], 10);
            var y = parseInt(comp[2], 10);
            var testDate = new Date(y, m - 1, d);

            if ((testDate.getFullYear() != y) || (testDate.getMonth() + 1 != m) || (testDate.getDate() != d)) {
                errorMessage = "Das angegebene Datum ist ung&uuml;ltig.<br />";
            } else {

                // Das Datum muss in der Zukunft liegen.
                var today = new Date();

                if (testDate < today) {
                    errorMessage = "Das angegebene Datum liegt in der Vergangenheit. Bitte geben Sie ein zuk&uuml;nftiges Datum an.<br />";
                }
            }
        }
    }
	
	return errorMessage;
}

// Uhrzeitvalidierung
function checkTime(time) {

	var errorMessage = "";

	// Zeitfeld darf nicht leer sein.
	if (time === "") {
        errorMessage += "Bitte geben Sie eine Uhrzeit an.<br />";
    } else {

        // Zeit muss dem Format hh:mm entsprechen.
        var timeRegex = new RegExp("^([01]?\\d|2[0-3]):([0-5]?\\d)$");

        if (!timeRegex.test(time)) {

            errorMessage += "\nDie angegebene Uhrzeit entspricht nicht dem g&uuml;ltigen Format (hh:mm).<br />";
        } else {

            // Öffnungszeiten berücksichtigen (17:00 - 23:00); späteste Reservierung: 21:00 Uhr
            var hours = parseInt(time.substr(0, 2));
            var minutes = parseInt(time.substr(3, 2));
            if (hours < 17 || hours > 21 || (hours == 21 && minutes > 0)) {
                errorMessage += "Bitte beachten Sie unsere &Ouml;ffnungszeiten: 17:00 - 23:00 Uhr. (Sp&auml;teste Reservierung: 21:00 Uhr.)<br />";
            }
        }
    }
	
	return errorMessage;
}

// Tischnummer validieren
function checkTableNo(tableNo) {

	var errorMessage = "";
	
    // Tischnummer darf nicht leer sein.
    if (tableNo === "") {
        errorMessage += "Bitte w&auml;hlen Sie einen Tisch aus.<br />";
    } else {

        // Die Tischnummer muss eine Zahl zwischen 1 und 22 sein.
        var tableNoInt = parseInt(tableNo);
        if ((tableNoInt != tableNo) || (tableNoInt < 1) || (tableNoInt > 22)) {
            errorMessage += "Die Tischnummer muss eine Zahl zwischen 1 und 22 sein.<br />";
        }
    }
	
	return errorMessage;
}

// Nachname validieren
function checkLastName(lastName) {

	var errorMessage = "";
	
	// Nachname darf nicht leer sein.
    if (lastName === "") {
        errorMessage += "Bitte geben Sie Ihren Nachnamen an.<br />";
    }
	
	return errorMessage;
}

// Email validieren
function checkEmail(email) {
	
	var errorMessage = "";
	
	// Email darf nicht leer sein.
	if (email === "") {
        errorMessage += "Bitte geben Sie Ihre Email-Adresse an.<br />";
    } else {

        // Email-Adresse muss dem folgenden Format entsprechen: 'wort@wort.wort'.
        var mailRegex = new RegExp("^.+@.+\\.[^.]{2,}$");

        if (!mailRegex.test(email)) {

            errorMessage += "Die angegebene Email-Adresse entspricht nicht dem g&uuml;ltigen Format. <br />" + "Beispiel f&uuml;r eine g&uuml;ltige Eingabe: ihr.name@provider.de<br />";
        }
    }
	
	return errorMessage;
}

// Captchavalidierung
function checkCaptcha(captcha) {
	
	var errorMessage = "";
	
	// Captcha darf nicht leer sein.
	if (captcha === "") {
		errorMessage += "Bitte best&auml;tigen Sie, dass Sie kein Roboter sind.";
	}

	return errorMessage;
}