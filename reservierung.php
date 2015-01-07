<!DOCTYPE html>

<html lang="de">

<?php
	require_once('php/db_config.php');

	echo "\n".MYSQL_HOST;
	echo "\n".MYSQL_USER;
	echo "\n".MYSQL_PW;
	echo "\n".MYSQL_DB;
	echo "\n".MYSQL_PORT;
	
	$db_link = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PW, MYSQL_DB, MYSQL_PORT);

	if($db_link)
	{
		echo 'Verbindung aufgebaut!';
		print_r($db_link);
	} 
	else 
	{
		exit("Verbindungsaufbau fehlgeschlagen: " . mysqli_connect_error());
	}
	
	mysqli_set_charset($db_link, 'utf8');
?>

<head>
    <meta charset="utf-8">
	
    <title>Reservierung</title>

    <!-- Imports ---------------------->
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Bootstrap CSS-->
    <link href="css/bootstrap.css" rel="stylesheet">


    <!-- Styles ---------------------->
    <style type="text/css">
        a {
            / word-wrap: break-word;
        }
        .header {
            padding-top: 20px;
            width: 95%;
            height: 50px;
            margin-left: auto;
            margin-right: auto;
        }
        .content {
            width: 95%;
            margin-left: auto;
            margin-right: auto;
        }
        .saalplan {
            max-width: 60%;
            min-width: 300px;
            height: auto;
            display: inline-block;
            margin: 20px 20px 20px 0px;
            float: left;
            
            padding: 0px 10px 0px 10px;
        }
        .reservierung {
            min-width: 30%;
            max-width: 400px;
            display: inline-block;
            margin: 20px;
        }
        .intro {
            margin: 0px 20px 0px 0px;
        }
        .reducedPadding {
            padding-top: 2px;
            padding-bottom: 2px;
        }
        .floatRight {
            float: right;
        }
		img[usemap] {
			border: none;
			height: auto;
			max-width: 100%;
			width: auto;
		}
    </style>

</head>

<body>

	<div class="header">

		<ul class="nav nav-tabs">
			<li role="presentation"><a href="#">Start</a>
			</li>
			<li role="presentation" class="active"><a href="#">Reservierung</a>
			</li>
			<li role="presentation"><a href="#">Kontakt</a>
			</li>
			<li role="presentation"><a href="#">Impressum</a>
			</li>
		</ul>

	</div>

	<div class="content" id="content">

		<div class="intro">
			<h1>Reservierung</h1>
			<p>Hier entsteht eine Seite für die Tischreservierung in unserem Resturant.</p>
			<?php echo 'PHP WORX'; ?>
		</div>

		<form name="booking_form">
		
			<div class="panel panel-default saalplan">
			
				<img src="images/saalplan.png" width="700" height="500" 
					 usemap="#table_map" alt="Bild des Saalplans" />
				
				<map name="table_map" id="table_map">
				
					<area id="t1" alt="Bereich Tisch1" title="Tisch 1" shape="rect" coords="611,384,650,453" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 1; return false' />
				
					<area id="t2" alt="Bereich Tisch2" title="Tisch 2" shape="rect" coords="645,264,686,296" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 2; return false' />
						  
					<area id="t3" alt="Bereich Tisch3" title="Tisch 3" shape="rect" coords="577,264,618,296" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 3; return false' />
						  
					<area id="t4" alt="Bereich Tisch4" title="Tisch 4" shape="rect" coords="576,196,617,228" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 4; return false' />
					
					<area id="t5" alt="Bereich Tisch5" title="Tisch 5" shape="rect" coords="645,196,686,228" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 5; return false' />
					
					<area id="t6" alt="Bereich Tisch6" title="Tisch 6" shape="rect" coords="403,422,439,468" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 6; return false' />
						  
					<area id="t7" alt="Bereich Tisch7" title="Tisch 7" shape="rect" coords="328,429,369,461" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 7; return false' />
						  
					<area id="t8" alt="Bereich Tisch8" title="Tisch 8" shape="rect" coords="258,422,293,467" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 8; return false' />
						  
					<area id="t9" alt="Bereich Tisch9" title="Tisch 9" shape="rect" coords="403,323,438,369" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 9; return false' />
						  
					<area id="t10" alt="Bereich Tisch10" title="Tisch 10" shape="rect" coords="328,326,369,359" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 10; return false' />
						  
					<area id="t11" alt="Bereich Tisch11" title="Tisch 11" shape="rect" coords="256,322,293,368" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 11; return false' />
						  
					<area id="t12" alt="Bereich Tisch12" title="Tisch 12" shape="rect" coords="366,132,407,165" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 12; return false' />
						  
					<area id="t13" alt="Bereich Tisch13" title="Tisch 13" shape="rect" coords="267,132,308,165" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 13; return false' />
						  
					<area id="t14" alt="Bereich Tisch14" title="Tisch 14" shape="rect" coords="366,44,407,77" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 14; return false' />
						  
					<area id="t15" alt="Bereich Tisch15" title="Tisch 15" shape="rect" coords="268,36,304,82" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 15; return false' />
						  
					<area id="t16" alt="Bereich Tisch16" title="Tisch 16" shape="rect" coords="147,379,182,443" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 16; return false' />
					
					<area id="t17" alt="Bereich Tisch17" title="Tisch 17" shape="rect" coords="145,281,186,313" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 17; return false' />
					
					<area id="t18" alt="Bereich Tisch18" title="Tisch 18" shape="rect" coords="143,156,184,188" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 18; return false' />
						  
					<area id="t19" alt="Bereich Tisch19" title="Tisch 19" shape="rect" coords="145,55,180,120" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 19; return false' />
						  
					<area id="t20" alt="Bereich Tisch20" title="Tisch 20" shape="rect" coords="32,353,70,457" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 20; return false' />
					
					<area id="t21" alt="Bereich Tisch21" title="Tisch 21" shape="rect" coords="32,192,70,296" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 21; return false' />
						  
					<area id="t22" alt="Bereich Tisch22" title="Tisch 22" shape="rect" coords="32,33,70,137" style="outline:none;"
						  href="#" onclick='javascript:document.booking_form.tnr.value = 22; return false' />
						  
				</map>
			
			</div>

			<div class="panel panel-default reservierung">

				<div class="panel-heading">
					<h3>Reservierung vornehmen</h3>
				</div>

				<div class="panel-body">

					<p>Datum: <span><input  class="form-control reducedPadding" type="text" placeholder=""></input></span>
					</p>
					<p>Uhrzeit: <span><input  class="form-control reducedPadding" type="text" placeholder=""></input></span>
					</p>
					<p>Tischnummer: <span><input  class="form-control reducedPadding" type="text" name="tnr" placeholder=""></input></span>
					</p>
					<p>Anzahl Personen: <span><input  class="form-control reducedPadding" type="text" placeholder=""></input></span>
					</p>

					<hr>

					<p>Vorname: <span><input class="form-control reducedPadding" type="text" placeholder="Vorname"></input></span>
					</p>
					<p>Name: <span><input  class="form-control reducedPadding" type="text" placeholder="Name"></input></span>
					</p>
					<p>Email: <span><input  class="form-control reducedPadding" type="text" placeholder="name@example.de"></input></span>
					</p>
					<p>Telefon: <span><input  class="form-control reducedPadding" type="text" placeholder="01234 567890"></input></span>
					</p>

					<hr>

					<button class="btn btn-primary reducedPadding floatRight" type="submit">Reservieren</button>

				</div>

			</div>

		</form>

	</div>

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/jquery.rwdImageMaps.min.js"></script>
	<script>
		$(document).ready(function(e) {
			$('img[usemap]').rwdImageMaps();
			
			$('area').on('click', function() {
				confirm('Sie haben ' + $(this).attr('title') + ' ausgewählt.');
			});
		});
	</script>
	
</body>

</html>
