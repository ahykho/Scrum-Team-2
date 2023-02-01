<!DOCTYPE html>
<?php
	session_unset();
	session_start();
?>

<html lang="de">
	<head>
		<meta charset="UTF-8">
		<title>Login</title>
		<link href="../style.css" rel="stylesheet" type="text/css"/>
                
                <!-- IMPORTIERE FONT AWESOME ICONS -->
		<script src="https://use.fontawesome.com/3da64393f5.js"></script>
	</head>
	 
	<body>
            <header>
		<p><div id="logo">
		<a href="../index.php"><img src="../img/logo.png" alt="XYZ Webhosting"></a>
		</div></p>
            </header>
            
		<article>
		<p>
		<h2>Bitte registrieren Sie sich.</h2>
		
		<form action = "<?php $_SERVER['PHP_SELF']; ?>" method = "GET"> 		<!-- Der Uebersicht halber GET statt POST, sollte spaeter ersetzt werden-->

			<p><h4>E-Mail-Adresse:</h4>
			<input type="text" name="email">
			</p>
			
			<p><h4>Username:</h4>
			<input type="text" name="username">
			</p>
			
			<p><h4>Vorname:</h4>
			<input type="text" name="vorname">
			</p>
			
			<p><h4>Nachname:</h4>
			<input type="text" name="nachname">
			</p>
                        
                        <p><h4>Stra&szlig;e:</h4>
			<input type="text" name="strasse">
			</p>
                        
                        <p><h4>Hausnummer:</h4>
			<input type="text" name="hausnr">
			</p>
                        
                        <p><h4>Postleitzahl:</h4>
			<input type="text" name="plz">
			</p>
                        
                        <p><h4>Stadt:</h4>
			<input type="text" name="stadt">
			</p>
                        
                        <p><h4>Land:</h4>
			<input type="text" name="land">
			</p>
			
			<p><h4>Passwort: </h4>
			<input type="password" name="passwort">
			</p>
			
			<p><input type="submit" name="register" value="Registrieren" class="button">
			</p>
		</p>
		</form>
	
	<!-- WEITERLEITUNG ZU LOGIN -->
	<h2>Sie haben schon ein Konto?</h2>
			<a href="login.php">
			<input type="submit" name="regis" value="Login" class="button"></a></p>
        
                                                    
            <!-- ZURUECK-BUTTON -->
            <p><a href="#" onclick="window.history.back();"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> zur&uuml;ck</a>             
            </p>

		
<?php
        // REGISTRATION
	if(isset($_GET['register'])){
		$connect = new mysqli("localhost", "root", "", "xyz");
                
                // TESTET, OB DER ACCOUNT EXISTIERT
		$sqlstmt = "SELECT email, benutzername FROM benutzer WHERE email ='" . $_GET['email'] . "' OR benutzername = '" . $_GET['username'] . "';";
		
                // NUR ZUR UEBERPRUEFUNG DER SYNTAX
                // echo $sqlstmt . "<br>";
																			
		$result = $connect->query($sqlstmt);
		
		// WENN KEIN ACCOUNT VORHANDEN, FUEGE VALUES EIN
		if($result->num_rows == 0){
                        $sqlstmt = "INSERT INTO benutzer (vorname, nachname, benutzername, email, kennwort) VALUES ('$_GET[vorname]', '$_GET[nachname]', '$_GET[username]', '$_GET[email]', '$_GET[passwort]') ";
                        $sqlstmt_ort = "INSERT INTO ort (strasse, hausnr, plz, stadt, land) VALUES ('$_GET[strasse]', '$_GET[hausnr]', '$_GET[plz]', '$_GET[stadt]', '$_GET[land]')";
                    
                        // NUR ZUR UEBERPRUEFUNG DER SYNTAX
                        // echo $sqlstmt_ort;
                        
                //      FUNKTIONIERT WEGEN HASHWERT NICHT??
		//	$sqlstmt = "INSERT INTO benutzer (vorname, nachname, benutzername, email, kennwort) VALUES ('$_GET[vorname]', '$_GET[nachname]', '$_GET[username]', '$_GET[email]', '" . MD5($_GET['passwort']) . "' )";
                                                                                                                                              //  gegen verwirrung der obigen zeichenkette: 
                                                                                                                                              //  open new value | open string | operator | VALUE | operator | close string | close value | close value BRACKET | close MAIN string
			
                        // NUR ZUR UEBERPRUEFUNG DER SYNTAX
                        // echo $sqlstmt . "<br>";
                        
			$result = $connect->query($sqlstmt);
                        $result_ort = $connect->query($sqlstmt_ort);
                        header("location: willkommen.php");
		} else {
			echo "Benutzername oder E-Mail bereits vergeben.<br>";
			while($datensatz = $result->fetch_assoc()){
				if($datensatz['email'] == $_GET['email']){
					echo "Die E-Mail-Adresse $_GET[email] ist bereits vergeben.<br>";
                                        }
                                }
                        }
	$connect->close();
	}
?>
		
		</article>
	</body>
</html>