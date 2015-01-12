function validateForm() {

    // alert('Validate-Funktion aufgerufen.');

    var isValid = true;
    var errorMessage = "";

    var date = $('#date').val();
    var time = $('#time').val();
    var email = $('#email').val();

    //alert('eingegebenes Datum = ' + date);
    //alert('eingegebene Zeit: ' + time);

    // Datumsvalidierung

    // Datum muss folgendem Format entsprechen: dd.mm.yyyy
    var dateRegex = new RegExp(
        "^(0?[1-9]|[12][0-9]|3[01])\\.(0?[1-9]|1[0-2])\\.(19|20)\\d\\d$");

    if (!dateRegex.test(date)) {

        // alert('Date entspricht nicht RegEx');

        errorMessage = "Das angegebene Datum entspricht nicht dem gültigen Format. <br>" + "Beispiel für eine gültige Eingabe: 01.01.2015";
        showErrorMsg(errorMessage);

        isValid = false;
    } else {

        // Datum muss gültig sein
        var comp = date.split('.');
        var m = parseInt(comp[1], 10);
        var d = parseInt(comp[0], 10);
        var y = parseInt(comp[2], 10);
        var testDate = new Date(y, m - 1, d);

        if ((testDate.getFullYear() != y) || (testDate.getMonth() + 1 != m) || (testDate.getDate() != d)) {
            errorMessage = "Das angegebene Datum ist ungültig.";
            showErrorMsg(errorMessage);

            isValid = false;
        }

    }

    // alert('Nach Datum: isValid = ' + isValid);

    // Uhrzeitvalidierung

    var timeRegex = new RegExp("^([01]?\\d|2[0-3]):([0-5]?\\d)$");

    if (!timeRegex.test(time)) {

        errorMessage = "Die angegebene Uhrzeit entspricht nicht dem gültigen Format. <br>" + "Beispiel für eine gültige Eingabe: 19:30";
        showErrorMsg(errorMessage);

        isValid = false;
    }

    // alert('isValid nach Zeit: ' + isValid);

    // E-Mailvalidierung

    var mailRegex = new RegExp("^.+@.+\\.[^.]{2,}$");

    if (!mailRegex.test(email)) {

        errorMessage = "Die angegebene Email-Adresse entspricht nicht dem gültigen Format. <br>" + "Beispiel für eine gültige Eingabe: ihr.name@provider.de";
        showErrorMsg(errorMessage);

        isValid = false;
    }

    return isValid;

}


function showErrorMsg(message) {

    $("#errorDiv").html(
        '<div class="alert alert-danger alert-dismissible"' + 'role="alert"><button type="button" class="close" ' + 'data-dismiss="alert" aria-label="Close"><span ' + 'aria-hidden="true">&times;</span></button>' + message + '</div>');

}