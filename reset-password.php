<html>
  <head>
    <style>
      .reset-form {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 30%;
        margin: 0 auto;
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
    <form class="reset-form" action="reset-password.php" method="post">
	
      <div class="form-control">
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email">
    </div>
	  
	  
	  <div class="form-control">
		<label for="password">Neues Passwort:</label>
		<input type="password" class="form-control" id="password" name="password">
	</div>
  
  
      <button type="submit">Passwort zuruecksetzen</button>
    </form>



<?php

		// Connect
		$connect = new mysqli("localhost", "root", "", "inventarisierung");


		// Check with post
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			
		  // Post instead of Get email und passwort
		  $email = $_POST['email'];
		  $password = $_POST['password'];

		  // Update accounts set passwort where email
		  $sqlstmt= "UPDATE accounts SET passwort='$password' WHERE email='$email'";
		  $result = $connect->query($sqlstmt);

		  if ($result) {
			header('Location: login.php');
		  } else {
			header('Location: reset-password.php');
		  }
		}

		// Close
		mysqli_close($connect);

?>



  </body>
</html>