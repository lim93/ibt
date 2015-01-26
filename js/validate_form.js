function validateForm() {

    var isValid = true;
    var errorMessage = "";

    var date = $('#date').val();
    var time = $('#time').val();
    var tableNo = $('#table_no').val();
    var lastName = $('#last_name').val();
    var email = $('#email').val();
	var captcha = $('#g-recaptcha-response').val();
	
    // Datumsvalidierung

    // Datumsfeld darf nicht leer sein
    if (date === "") {
        errorMessage = "Bitte geben Sie ein Datum an.<br />";
    } else {

        // Datum muss folgendem Format entsprechen: dd.mm.yyyy
        var dateRegex = new RegExp(
            "^(0?[1-9]|[12][0-9]|3[01])\\.(0?[1-9]|1[0-2])\\.(19|20)\\d\\d$");

        if (!dateRegex.test(date)) {

            errorMessage = "Das angegebene Datum entspricht nicht dem g&uuml;ltigen Format. <br />" + "Beispiel f&uuml;r eine g&uuml;ltige Eingabe: 01.01.2015<br />";
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

    // Uhrzeitvalidierung

    // Uhrzeitfeld darf nicht leer sein.
    if (time === "") {
        errorMessage += "Bitte geben Sie eine Uhrzeit an.<br />";
    } else {

        // Zeit muss dem Format hh:mm entsprechen.
        var timeRegex = new RegExp("^([01]?\\d|2[0-3]):([0-5]?\\d)$");

        if (!timeRegex.test(time)) {

            errorMessage += "\nDie angegebene Uhrzeit entspricht nicht dem g&uuml;ltigen Format. <br />" + "Beispiel f&uuml;r eine g&uuml;ltige Eingabe: 19:30<br />";
        } else {

            // Öffnungszeiten berücksichtigen (17:00 - 23:00); späteste Reservierung: 21:00 Uhr
            var hours = parseInt(time.substr(0, 2));
            var minutes = parseInt(time.substr(3, 2));
            if (hours < 17 || hours > 21 || (hours == 21 && minutes > 0)) {
                errorMessage += "Bitte beachten Sie unsere &Ouml;ffnungszeiten: 17:00 - 23:00 Uhr. (Sp&auml;teste Reservierung: 21:00 Uhr.)<br />";
            }
        }
    }

    // Tischnummer validieren

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

    // Nachname validieren

    // Nachname darf nicht leer sein.
    if (lastName === "") {
        errorMessage += "Bitte geben Sie Ihren Nachnamen an.<br />";
    }

    // E-Mailvalidierung

    // E-Mailfeld darf nicht leer sein.
    if (email === "") {
        errorMessage += "Bitte geben Sie Ihre Email-Adresse an.<br />";
    } else {

        // Email-Adresse muss dem folgenden Format entsprechen: 'wort@wort.wort'.
        var mailRegex = new RegExp("^.+@.+\\.[^.]{2,}$");

        if (!mailRegex.test(email)) {

            errorMessage += "Die angegebene Email-Adresse entspricht nicht dem g&uuml;ltigen Format. <br />" + "Beispiel f&uuml;r eine g&uuml;ltige Eingabe: ihr.name@provider.de<br />";
        }
    }

	// Captcha-Validierung
	if (captcha === "") {
		errorMessage += "Bitte bestätigen Sie, dass Sie kein Roboter sind.";
	}
	
    if (errorMessage.length > 0) {
        isValid = false;
        showErrorMsg(errorMessage);
    }
	
    return isValid;

}

function showErrorMsg(message) {

    $("#errorDiv").html('<div class="alert alert-danger" role="alert">' + message + '</div>');

}

function isAvailable() {
	// alert('Datum oder Tischnummer lost focus');
	
	var date = $('#date').val();
	var tableNo = $('#table_no').val();
	var dateError = "";
	var tableError = "";
	
	if (date == "" || tableNo == "") {
		document.getElementById("infoDiv").innerHTML = "";
		return;
	} else {
		// alert('Beide Felder gefüllt. Date = ' + date + ', Tisch ' + tableNo);
		
		dateError = checkDate(date);
		tableError = checkTableNo(tableNo);
		
		// alert('Date Error Message: ' + dateError);
		// alert('Table Error Message: ' + tableError); 
		
		if (dateError === "" && tableError === "") {
			// alert('Datum und Tischnummer korrekt ausgefüllt');
			
			var dateParts = date.split(".");
			var mysqlDate = "" + dateParts[2] + dateParts[1] + dateParts[0];
			
			// alert('mysqlDate: ' + mysqlDate);
			
			if (window.XMLHttpRequest) {
				// alert('XMLHttpRequest angelegt');
				xmlhttp = new XMLHttpRequest();
			} else {
				// alert('ActiveXObject angelegt');
				xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			xmlhttp.onreadystatechange = function() {
				if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
					// alert('Response Text: ' + xmlhttp.responseText);
					document.getElementById("infoDiv").innerHTML = xmlhttp.responseText;
				} else {
					// alert(xmlhttp.statusText);
				}
			}
			xmlhttp.open("GET","php/is_available.php?date="+mysqlDate+"&table="+tableNo,true);
			xmlhttp.send();
		}
	}
}

function checkDate(date) {
	// Datumsvalidierung
	
	var errorMessage = "";
	
    // Datumsfeld darf nicht leer sein
    if (date === "") {
        errorMessage = "Bitte geben Sie ein Datum an.<br />";
    } else {

        // Datum muss folgendem Format entsprechen: dd.mm.yyyy
        var dateRegex = new RegExp(
            "^(0?[1-9]|[12][0-9]|3[01])\\.(0?[1-9]|1[0-2])\\.(19|20)\\d\\d$");

        if (!dateRegex.test(date)) {

            errorMessage = "Das angegebene Datum entspricht nicht dem g&uuml;ltigen Format. <br />" + "Beispiel f&uuml;r eine g&uuml;ltige Eingabe: 01.01.2015<br />";
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

function checkTableNo(tableNo) {
	// Tischnummer validieren

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