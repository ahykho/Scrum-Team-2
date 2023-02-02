<!DOCTYPE html>
<?php
	session_unset();
	session_start();
?>


<html>
  <head>
    <style>
      .login-form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .form-control {
        margin: 1em 0;
        text-align: center;
      }
      .form-control label {
        display: block;
      }
      .form-control input {
        padding: 0.5em;
        font-size: 1em;
        width: 100%;
      }
    </style>
  </head>


  <body>
    <form class="login-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
      <div class="form-control">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email">
      </div>
      <div class="form-control">
        <label for="password">Passwort:</label>
        <input type="password" id="password" name="password">
      </div>
	  <div class="form-control right-aligned">
        <a href="reset-password.php">Passwort vergessen?! ;@ </a>
      </div>
      <div class="form-control">
        <a href="registrieren.php">Registrierung</a>
      </div>
      <button type="submit" name="submit">Absenden</button>
    </form>



    <?php

    if (isset($_GET['submit'])) {
        $connect = new mysqli("localhost", "root", "", "inventarisierung");

        $sqlstmt = "SELECT * FROM accounts WHERE email ='" . $_GET['email'] . "' AND passwort ='" . $_GET['password'] . "';";

        // echo $sqlstmt;

        $result = $connect->query($sqlstmt);

        if ($result->num_rows > 0) {
            $datensatz = $result->fetch_assoc();
            echo "Anmeldung erfolgreich.";
            echo "<br> Hallo " . $datensatz['vorname'] . " " . $datensatz['nachname'];
            $_SESSION['id'] = $datensatz['id'];
            $_SESSION['vorname'] = $datensatz['vorname'];
            $_SESSION['nachname'] = $datensatz['nachname'];

            // WEITERLEITUNG
            header("location: verwaltung.php");

            exit();
        } else {
            session_destroy();
            echo "Anmeldung fehlgeschlagen. Bitte registrieren Sie sich.<br>";
        }
        $connect->close();
    }
    ?>
  </body>
</html>
