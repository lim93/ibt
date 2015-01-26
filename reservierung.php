<!DOCTYPE html>

<html lang="de">

<?php require_once "php/recaptcha_config.php" ?>

<head>
    <meta charset="utf-8">

    <title>Reservierung</title>

    <!-- Imports ---------------------->
    <!-- Bootstrap JS -->
    <script src="js/bootstrap.js"></script>

    <!-- jQuery -->
    <script src="js/jquery-1.11.1.js"></script>

    <!-- Sticky Header -->
    <script src="js/sticky.js"></script>

    <!-- Bootstrap CSS-->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Validierung / Plausibilitätsprüfung -->
    <script type="text/javascript" src="js/validate_form.js"></script>

    <!-- reCAPTCHA API -->
    <script src="https://www.google.com/recaptcha/api.js?hl=<?php echo LANG;?>"></script>
    <!-- async defer -->

    <!-- Image Map -->
    <script src="js/jquery.rwdImageMaps.min.js"></script>
    <script>
        $(document).ready(function (e) {
            $('img[usemap]').rwdImageMaps();

            $('area').on('click', function () {

                $("#infoDiv").html(
                    '<div class="alert alert-info" role="alert">Sie haben ' + $(this).attr("title") + ' ausgewählt.</div>');
            });


        });
    </script>


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
        .saalplan {
            max-width: 60%;
            min-width: 300px;
            height: auto;
            display: inline-block;
            margin: 20px 20px 20px 0px;
            float: left;
            padding: 10px;
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
            <h1>Reservierung</h1>
            <p>Hier entsteht eine Seite f&uuml;r die Tischreservierung in unserem Resturant.</p>
        </div>

        <form name="booking_form" action="confirm.php" method="post" onsubmit="return validateForm();">

            <div class="panel panel-default saalplan">

                <img src="images/saalplan.png" width="700" height="500" usemap="#table_map" alt="Bild des Saalplans" />

                <map name="table_map" id="table_map">

                    <area id="t1" alt="Bereich Tisch1" title="Tisch 1" shape="rect" coords="611,384,650,453" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 1; return false' />

                    <area id="t2" alt="Bereich Tisch2" title="Tisch 2" shape="rect" coords="645,264,686,296" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 2; return false' />

                    <area id="t3" alt="Bereich Tisch3" title="Tisch 3" shape="rect" coords="577,264,618,296" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 3; return false' />

                    <area id="t4" alt="Bereich Tisch4" title="Tisch 4" shape="rect" coords="576,196,617,228" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 4; return false' />

                    <area id="t5" alt="Bereich Tisch5" title="Tisch 5" shape="rect" coords="645,196,686,228" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 5; return false' />

                    <area id="t6" alt="Bereich Tisch6" title="Tisch 6" shape="rect" coords="403,422,439,468" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 6; return false' />

                    <area id="t7" alt="Bereich Tisch7" title="Tisch 7" shape="rect" coords="328,429,369,461" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 7; return false' />

                    <area id="t8" alt="Bereich Tisch8" title="Tisch 8" shape="rect" coords="258,422,293,467" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 8; return false' />

                    <area id="t9" alt="Bereich Tisch9" title="Tisch 9" shape="rect" coords="403,323,438,369" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 9; return false' />

                    <area id="t10" alt="Bereich Tisch10" title="Tisch 10" shape="rect" coords="328,326,369,359" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 10; return false' />

                    <area id="t11" alt="Bereich Tisch11" title="Tisch 11" shape="rect" coords="256,322,293,368" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 11; return false' />

                    <area id="t12" alt="Bereich Tisch12" title="Tisch 12" shape="rect" coords="366,132,407,165" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 12; return false' />

                    <area id="t13" alt="Bereich Tisch13" title="Tisch 13" shape="rect" coords="267,132,308,165" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 13; return false' />

                    <area id="t14" alt="Bereich Tisch14" title="Tisch 14" shape="rect" coords="366,44,407,77" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 14; return false' />

                    <area id="t15" alt="Bereich Tisch15" title="Tisch 15" shape="rect" coords="268,36,304,82" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 15; return false' />

                    <area id="t16" alt="Bereich Tisch16" title="Tisch 16" shape="rect" coords="147,379,182,443" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 16; return false' />

                    <area id="t17" alt="Bereich Tisch17" title="Tisch 17" shape="rect" coords="145,281,186,313" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 17; return false' />

                    <area id="t18" alt="Bereich Tisch18" title="Tisch 18" shape="rect" coords="143,156,184,188" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 18; return false' />

                    <area id="t19" alt="Bereich Tisch19" title="Tisch 19" shape="rect" coords="145,55,180,120" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 19; return false' />

                    <area id="t20" alt="Bereich Tisch20" title="Tisch 20" shape="rect" coords="32,353,70,457" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 20; return false' />

                    <area id="t21" alt="Bereich Tisch21" title="Tisch 21" shape="rect" coords="32,192,70,296" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 21; return false' />

                    <area id="t22" alt="Bereich Tisch22" title="Tisch 22" shape="rect" coords="32,33,70,137" style="outline:none;" href="#" onclick='javascript:document.booking_form.table_no.value = 22; return false' />

                </map>

            </div>

            <div class="panel panel-default reservierung">

                <div class="panel-heading">
                    <h3>Reservierung vornehmen</h3>
                </div>

                <div class="panel-body">

                    <p>Datum: *<span><input  class="form-control reducedPadding" type="text" name="date"  id="date" placeholder="tt.mm.jjjj"></input></span>
                    </p>
                    <p>Uhrzeit: *<span><input  class="form-control reducedPadding" type="text" name="time" id="time" placeholder="hh:mm"></input></span>
                    </p>
                    <p>Tischnummer: *<span><input  class="form-control reducedPadding" type="text" name="table_no" id="table_no" placeholder=""></input></span> 
                        <div id="infoDiv"></div>
                    </p>
                    <p>Anzahl Personen: <span><input  class="form-control reducedPadding" type="text" name="persons" id="persons" placeholder=""></input></span>
                    </p>

                    <hr>

                    <p>Vorname:<span><input class="form-control reducedPadding" type="text" name="first_name" id="first_name" placeholder="Vorname"></input></span>
                    </p>
                    <p>Name: *<span><input  class="form-control reducedPadding" type="text" name="last_name" id="last_name" placeholder="Name"></input></span>
                    </p>
                    <p>Email: *<span><input  class="form-control reducedPadding" type="text" name="email" id="email" placeholder="name@example.de"></input></span>
                    </p>
                    <p>Telefon: <span><input  class="form-control reducedPadding" type="text" name="phone" id="phone" placeholder="01234 567890"></input></span>
                    </p>

                    <hr>

                    <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY;?>"></div><br/>

                    <div id="errorDiv"></div>

                    <button class="btn btn-primary reducedPadding floatRight" type="submit">Reservieren</button>

                </div>

            </div>

        </form>

    </div>

</body>

</html>
