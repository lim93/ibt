<?php
function getDbLink() {
	require_once "db_config.php"; 

	$dbLink = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, MYSQL_PORT); 

	if(mysqli_connect_errno()) { 
		exit("Verbindungsaufbau fehlgeschlagen: %s\n" . mysqli_connect_error());
	} 
	if(!$dbLink->set_charset("utf8")){
		exit("Charset-Problem: " . $db_link->error);
	} 
	
	return $dbLink;
}

function checkPostParams() {
	return (isset($_POST['date']) and isset($_POST['time']) and isset($_POST['table_no']) 
        and isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['email']) 
        and $_POST['date'] != "" and $_POST['time'] != "" and $_POST['table_no'] != ""  
        and $_POST['first_name'] !=  "" and $_POST['last_name'] != "" and $_POST['email'] != "");
}

function verifyCaptcha() {

	require_once "recaptchalib.php";
	require_once "recaptcha_config.php";

	$resp = null;
	// $error = null;
	
	$reCaptcha = new ReCaptcha(SECRET_KEY);
	// echo "Response-String: " . $_POST["g-recaptcha-response"] . "<br />";

	$resp = $reCaptcha->verifyResponse(
		$_SERVER["REMOTE_ADDR"],
		$_POST["g-recaptcha-response"]
	);

	if ($resp->errorCodes != null) {
		echo $resp->errorCodes;
	}
	
	return true;
	// zu ersetzen durch: 
	// return $resp->success;
}

function isAvailable($dbLink, $date, $tableNo) {
	
	$isAvailable = true;
	$sql = "SELECT id FROM bookings WHERE date = $date AND table_no = $tableNo";
	
	if ($result = $dbLink->query($sql)) {
	
		$row_cnt = $result->num_rows;
		if ($row_cnt > 0) {
			$isAvailable = false;
		}
		
		$result->close();
	}
	
	return $isAvailable;
}

?>