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
        <H2>Daten &auml;ndern</h2>
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
      <a href="verwaltung.php"><button type="submit" name="aendern">Absenden</a></button>
    </form>

  </body>
</html>