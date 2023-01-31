<?php
	session_unset();
	// session_destroy();
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
        <a href="reset-password.html">Passwort vergessen?! :O </a>
      </div>
      <div class="form-control">
        <a href="register.html">Registrierung</a>
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
            echo "login succesful";
            echo "<br> Hallo " . $datensatz['vorname'] . ". " . $datensatz['nachname'];
            $_SESSION['id'] = $datensatz['ID'];
            $_SESSION['vorname'] = $datensatz['Vorname'];
            $_SESSION['nachname'] = $datensatz['Nachname'];

            // WEITERLEITUNG
            header("location: willkommen.php");

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
