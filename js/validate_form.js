function validateForm() {
			
	// alert('Validate-Funktion aufgerufen.');
	
	var isValid = true;
	var errorMessage = "";
	
	var date = document.booking_form.date.value;
	var time = document.booking_form.time.value;
	
	// alert('eingegebenes Datum = ' + date);
	alert('eingegebene Zeit: ' + time);
	
	// Datumsvalidierung
	
	// Datum muss folgendem Format entsprechen: dd.mm.yyyy
	var dateRegex = new RegExp(
		"^(0?[1-9]|[12][0-9]|3[01])\\.(0?[1-9]|1[0-2])\\.(19|20)\\d\\d$");

	if (!dateRegex.test(date)) {
	
		// alert('Date entspricht nicht RegEx');
	
		errorMessage = "Das angegebene Datum entspricht nicht dem gültigen Format. "
						+ "Beispiel für eine gültige Eingabe: 01.01.2015";
		alert(errorMessage);

		isValid = false;
	} else {

		// Datum muss gültig sein
		var comp = date.split('.');
		var m = parseInt(comp[1], 10);
		var d = parseInt(comp[0], 10);
		var y = parseInt(comp[2], 10);
		var testDate = new Date(y, m - 1, d);

		if ((testDate.getFullYear() != y) || (testDate.getMonth() + 1 != m)
				|| (testDate.getDate() != d)) {
			errorMessage = "Das angegebene Datum ist ungültig.";
			alert(errorMessage);

			isValid = false;
		}
	
	}
	
	// alert('Nach Datum: isValid = ' + isValid);
	
	// Uhrzeitvalidierung
	
	var timeRegex = new RegExp("^([01]?\\d|2[0-3]):([0-5]?\\d)$");
	
	if (!timeRegex.test(time)) {
		
		errorMessage = "Die angegebene Uhrzeit entspricht nicht dem gültigen Format. "
		                + "Beispiel für eine gültige Eingabe: 19:30";
		alert(errorMessage);
		
		isValid = false;
	}
	
	// alert('isValid nach Zeit: ' + isValid);
	
	return isValid;

}