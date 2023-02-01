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
        <label for="lastname">Nachname:</label>
        <input type="text" id="lastname" name="lastname">
      </div>
      <div class="form-control">
        <label for="firstname">Vorname:</label>
        <input type="text" id="firstname" name="firstname">
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
        <label for="zipcode">PLZ:</label>
        <input type="text" id="zipcode" name="zipcode">
      </div>
      <div class="form-control">
        <label for="location">Standort:</label>
        <input type="text" id="location" name="location">
      </div>
      <div class="form-control">
        <label for="rolle">Rolle:</label>
        <input type="text" id="rolle" name="rolle">
      </div>
      <div class="form-control">
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password">
      </div>
      <div class="form-control">
        <label for="employeenumber">Mitarbeiter Nummer:</label>
        <input type="text" id="employeenumber" name="employeenumber">
      </div>
      <div class="form-control">
        <label for="hiredate">Einstellungsdatum:</label>
        <input type="text" id="hiredate" name="hiredate">
      </div>
      <button type="submit" name="registrieren">Absenden</button>
    </form>


    <?php


	if(isset($_GET['registrieren'])){


		$con = new mysqli("localhost", "root", "", "inventarisierung");
	// prüfen, ob Account schon vorhanden
		$sqlstmt = "SELECT email, vorname, nachname 
                    FROM accounts 
                    WHERE email = '" . $_GET['email'] . "' OR vorname = '" . $_GET['firstname'] . "' OR nachname = '" . $_GET['lastname'] . "';";
		// echo $sqlstmt . "<br>";
		$query = $con->query($sqlstmt);
	// in $query sollten unsere Ergebnis-Datensätze stehen


		if ($query->num_rows == 0){
			$sqlstmt = "INSERT INTO accounts (vorname, nachname, mitarbeiternr, email, passwort) 
      VALUES ('$_GET[firstname]', 
              '$_GET[lastname]',
              '$_GET[employeenumber]',
              '$_GET[email]',
              '$_GET[password]') ";
			echo $sqlstmt . "<br>";
	
			$query = $con->query($sqlstmt);
      echo "Registrierung erfolgreich abgeschlossen";
			header("location: login.php");


		} else {
        echo "Dieser Account ist bereits vorhanden.<br>";
        while($ds = $query->fetch_assoc()){
          if($ds['email'] == $_GET['email']){
            echo "Die Mailadresse $_GET[email] ist bereits registriert.<br>";
          }
        }
		}
		$con->close();
	}
?>
  </body>
</html>
