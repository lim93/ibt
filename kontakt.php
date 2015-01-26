<!DOCTYPE html>

<head>
    <meta charset="utf-8">

    <title>Ristorante l'Imaginario</title>

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
        .kontaktformular {
            max-width: 60%;
            min-width: 350px;
            height: auto;
            display: inline-block;
            margin: 20px 20px 20px 0px;
            float: left;
        }
        .anschrift {
            min-width: 30%;
            max-width: 400px;
            display: inline-block;
            margin: 20px;
        }
        .captchaError {
            color: red;
            font-weight: bold;
        }
        .submitSuccess {
            color: green;
            font-weight: bold;
        }
        #recaptcha_response_field {
            height: auto !important;
        }
        #formPreview input,
        #formPreview select {
            display: block;
            width: 128px;
            height: 30px;
            float: left;
        }
        #formPreview label {
            display: block;
            float: left;
            font-size: 15px;
            width: 90px;
            line-height: 24px;
        }
        #formPreview .formdiv {
            margin: 11px 0;
        }
        #formPreview textarea {
            width: 100%;
            height: 115px;
        }
        .intro {
            margin: 0px 20px 0px 0px;
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
                <li role="presentation"><a href="reservierung.php">Reservierung</a>
                </li>
                <li role="presentation" class="active"><a href="kontakt.php">Kontakt</a>
                </li>
                <li role="presentation"><a href="impressum.php">Impressum</a>
                </li>
            </ul>
        </div>

    </div>

    <div class="content" id="content">

        <div class="intro">
            <h1>Kontakt</h1>
            <p>Kritik, Wünsche oder Anregungen? Schreiben Sie uns über unser Kontaktformular:</p>
        </div>

        <div>

            <div class="panel panel-default kontaktformular" id="formPreview">

                <div class="panel-heading">
                    <h3>Kontaktformular</h3>
                </div>
                <div class="panel-body">
                    <form action="#" method="post" class="clear">



                        <div id="formName" class="clear">
                            <div id="formtAnrede" class="clear formdiv">
                                <div class="layout">
                                    <label for="anrede">Anrede:</label>
                                    <select name="anrede" id="anrede">
                                        <option value="Herr">Herr</option>
                                        <option value="Frau">Frau</option>
                                        <option value="Dipl. Ing.">Dipl. Ing.</option>
                                        <option value="Prof.">Prof.</option>
                                        <option value="Prof. Dr.">Prof. Dr.</option>
                                        <option value="Herr Dr.">Herr Dr.</option>
                                        <option value="Frau Dr.">Frau Dr.</option>
                                    </select>
                                </div>
                                <br></br>
                            </div>
                            <div class="clear formdiv">
                                <div class="layout">
                                    <label for="vorname">Vorname:*</label>
                                    <input class="form-control " value="" type="text" name="vorname" id="vorname">
                                </div>
                                <br></br>
                                <div class="layout">
                                    <label for="nachname">Nachname:*</label>
                                    <input class="form-control " value="" type="text" name="nachname" id="nachname">
                                </div>
                                <br></br>
                            </div>
                        </div>
                        <!-- end kontaktName -->

                        <div id="kontaktEmail" class="clear formdiv">
                            <div class="layout">
                                <label for="email">Email:*</label>
                                <input class="form-control " value="" type="text" name="email" id="email">
                            </div>
                            <br></br>
                        </div>

                        <div id="kontaktTelefon" class="clear formdiv">
                            <div class="layout">
                                <label for="telefon">Telefon:</label>
                                <input class="form-control " value="" type="text" name="telefon" id="telefon">
                            </div>
                            <br></br>
                        </div>
                        <!-- end kontaktTelefon -->

                        <br class="clear">
                        <label for="message">Nachricht:*</label>
                        <textarea class="form-control" style="height:187px;resize:none;" name="message" id="message"></textarea>

                        <div style="margin-top:10px">
                            <script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=6LfRwMwSAAAAAN-2W8iJMCXSM0iTTDjzNVJ-oRb_"></script>

                            <noscript>
                                <iframe src="http://www.google.com/recaptcha/api/noscript?k=6LfRwMwSAAAAAN-2W8iJMCXSM0iTTDjzNVJ-oRb_" height="300" width="500" frameborder="0"></iframe>
                                <br/>
                                <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
                                <input type="hidden" name="recaptcha_response_field" value="manual_challenge" />
                            </noscript>
                        </div>

                        <button class="btn btn-primary" style="margin-top:10px;" type="submit" name="submit" id="sendkontakt">Absenden</button>
                        <br class="clear">
                        <p style="margin-top:20px;">Die mit * gekennzeichneten Felder m&uuml;ssen ausgef&uuml;llt werden.</p>

                    </form>
                </div>


            </div>

            <div class="panel panel-default anschrift">

                <div class="panel-heading">
                    <h3>Anschrift</h3>
                </div>
                <div class="panel-body">

                    <h4>Ristorante l'Imaginario</h4> 
                    <p>Bruchstr. 6
                        <br>45883 Gelsenkirchen</p>
                    <p>Telefon: (0211) - 963411
                        <br>E-Mail: <a href='mailto:info@Imaginario.de'>info@Imaginario.de</a>
                        </br>
                    </p>

                </div>
            </div>



        </div>

    </div>

</body>

</html>