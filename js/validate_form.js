function validateForm() {

    // alert('Validate-Funktion aufgerufen.');

    var isValid = true;
    var errorMessage = "";

    var date = $('#date').val();
    var time = $('#time').val();
	var tableNo = $('#table_no').val();
	var firstName = $('#first_name').val();
	var lastName = $('#last_name').val();
	var email = $('#email').val();
	
    //alert('eingegebenes Datum = ' + date);
    //alert('eingegebene Zeit: ' + time);

    // Datumsvalidierung

	// Datumsfeld darf nicht leer sein
	if (date === "") {
		errorMessage = "Bitte geben Sie ein Datum an.<br />";
		isValid = false;
	} else {
	
		// Datum muss folgendem Format entsprechen: dd.mm.yyyy
		var dateRegex = new RegExp(
			"^(0?[1-9]|[12][0-9]|3[01])\\.(0?[1-9]|1[0-2])\\.(19|20)\\d\\d$");

		if (!dateRegex.test(date)) {

			// alert('Date entspricht nicht RegEx');

			errorMessage = "Das angegebene Datum entspricht nicht dem gültigen Format. <br>" + "Beispiel für eine gültige Eingabe: 01.01.2015<br />";
			isValid = false;
		} else {

			// Datum muss gültig sein (30.02. etc. ausschließen)
			var comp = date.split('.');
			var d = parseInt(comp[0], 10);
			var m = parseInt(comp[1], 10);
			var y = parseInt(comp[2], 10);
			var testDate = new Date(y, m - 1, d);

			if ((testDate.getFullYear() != y) || (testDate.getMonth() + 1 != m) || (testDate.getDate() != d)) {
				errorMessage = "Das angegebene Datum ist ungültig.<br />";
				isValid = false;
			} else {
			
				// Das Datum muss in der Zukunft liegen.
				var today = new Date();
				
				if (testDate < today) {
					errorMessage = "Das angegebene Datum liegt in der Vergangenheit. Bitte geben Sie ein zukünftiges Datum an.<br />";
					isValid = false;
				}
			}
		}
	}

    // alert('Nach Datum: isValid = ' + isValid);

    // Uhrzeitvalidierung

	// Uhrzeitfeld darf nicht leer sein.
	if (time === "") {
		errorMessage += "Bitte geben Sie eine Uhrzeit an.<br />";
		isValid = false;
	} else {
	
		// Zeit muss dem Format hh:mm entsprechen.
		var timeRegex = new RegExp("^([01]?\\d|2[0-3]):([0-5]?\\d)$");

		if (!timeRegex.test(time)) {

			errorMessage += "\nDie angegebene Uhrzeit entspricht nicht dem gültigen Format. <br />" + "Beispiel für eine gültige Eingabe: 19:30<br />";
			isValid = false;
		}
	}

    // alert('isValid nach Zeit: ' + isValid);

	// Tischnummer validieren
	
	// Tischnummer darf nicht leer sein.
	if (tableNo === "") {
		errorMessage += "Bitte wählen Sie einen Tisch aus.<br />";
		isValid = false;		
	} else {
	
		// Die Tischnummer muss eine Zahl zwischen 1 und 22 sein.
		var tableNoInt = parseInt(tableNo);
		if ((tableNoInt != tableNo) || (tableNoInt < 1) || (tableNoInt > 22)) {
			errorMessage += "Die Tischnummer muss eine Zahl zwischen 1 und 22 sein.<br />";
			isValid = false;
		}
	}
	
	// Vorname validieren
	
	// Vorname darf nicht leer sein.
	if (firstName === "") {
		errorMessage +="Bitte geben Sie Ihren Vornamen an.<br />";
		isValid = false;
	}
	
	
	// Nachname validieren
	
	// Nachname darf nicht leer sein.
	if (lastName === "") {
		errorMessage += "Bitte geben Sie Ihren Nachnamen an.<br />";
		isValid = false;
	}
	
    // E-Mailvalidierung

	// E-Mailfeld darf nicht leer sein.
	if (email === "") {
		errorMessage += "Bitte geben Sie Ihre Email-Adresse an.<br />";
		
		isValid = false;
    } else {
	
		// Email-Adresse muss dem folgenden Format entsprechen: 'wort@wort.wort'.
		var mailRegex = new RegExp("^.+@.+\\.[^.]{2,}$");
		
		if (!mailRegex.test(email)) {

			errorMessage += "Die angegebene Email-Adresse entspricht nicht dem gültigen Format. <br />" + "Beispiel für eine gültige Eingabe: ihr.name@provider.de<br />";

			isValid = false;
		}
    }

	if (errorMessage.length > 0) {
		showErrorMsg(errorMessage);
	}
	
    return isValid;

}


function showErrorMsg(message) {

    $("#errorDiv").html(
        '<div class="alert alert-danger alert-dismissible"' + 'role="alert"><button type="button" class="close" ' + 'data-dismiss="alert" aria-label="Close"><span ' + 'aria-hidden="true">&times;</span></button>' + message + '</div>');

}