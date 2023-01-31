<?php
	session_unset();
	// session_destroy();
	session_start();
?>
<html>
  <head>
    <style>
      .registration-form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .form-control {
        margin: 1em 0;
      }
      .form-control label {
        display: block;
        text-align: left;
      }
      .form-control input {
        padding: 0.5em;
        font-size: 1em;
        width: 100%;
      }
    </style>
  </head>
  <body>
    <form class="registration-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
      <div class="form-control">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-control">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
      </div>
      <div class="form-control">
        <label for="first-name">Vorname:</label>
        <input type="text" id="first-name" name="first-name">
      </div>
      <div class="form-control">
        <label for="street">Strasse:</label>
        <input type="text" id="street" name="street">
      </div>
      <div class="form-control">
        <label for="city">Ort:</label>
        <input type="text" id="city" name="city">
      </div>
      <div class="form-control">
        <label for="zip-code">PLZ:</label>
        <input type="text" id="zip-code" name="zip-code">
      </div>
      <div class="form-control">
        <label for="location">Standort:</label>
        <input type="text" id="location" name="location">
      </div>
      <div class="form-control">
        <label for="status">Status:</label>
        <input type="text" id="status" name="status">
      </div>
      <div class="form-control">
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password">
      </div>
      <div class="form-control">
        <label for="employee-number">Mitarbeiter Nummer:</label>
        <input type="text" id="employee-number" name="employee-number">
      </div>
      <div class="form-control">
        <label for="hire-date">Einstellungsdatum:</label>
        <input type="date" id="hire-date" name="hire-date">
      </div>
      <button type="submit" name="registrieren">Absenden</button>
    </form>
    <?php
	if(isset($_GET['registrieren'])){
		$con = new mysqli("localhost", "root", "", "inventarisierung");
	// prüfen, ob Account schon vorhanden
		$sqlstmt = "SELECT email, vorname, nachname FROM accounts WHERE email = '" . $_GET['email'] . "' OR vorname = '" . $_GET['first-name'] . "' OR nachname = '" . $_GET['nachname'] . "';";
		echo $sqlstmt . "<br>";
		$query = $con->query($sqlstmt);
	// in $query sollten unsere Ergebnis-Datensätze stehen
		if ($query->num_rows == 0){
			$sqlstmt = "INSERT INTO tblnutzer (vorname, nachname, email, nickname, userID, passwort) VALUES ('$_GET[vname]', '$_GET[nname]', '$_GET[mail]', '$_GET[nick]', '$_GET[userid]', '" . MD5($_GET['passwort']) . "');";
			echo $sqlstmt . "<br>";
			// getestet hubert1, ghjhtzrf
			$query = $con->query($sqlstmt);
			header("location: login.php");
		} else {
			echo "Dieser Account ist bereits vorhanden.<br>";
			while($ds = $query->fetch_assoc()){
				if($ds['email'] == $_GET['mail']){
					echo "Die Mailadresse $_GET[mail] ist bereits registriert.<br>";
				}
			}
		}
		$con->close();
	}
?>
  </body>
</html>
