<?php
  if (isset($_POST['submit'])) {
    // Connect to the database
    $conn = mysqli_connect('host', 'username', 'password', 'database');

    // Get the submitted username and password
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check the credentials against the database
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      // Login success
      // Redirect to a secure page
      header('Location: secure.php');
    } else {
      // Login failed
      echo "Incorrect username or password";
    }
    // Hash the password for security
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    mysqli_query($conn, $sql);
 
    // Redirect to the login page
    header('Location: login.php');
  }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <style>
        form {
        text-align: center;
        }
        h1 {
        text-align: center;
        }
        input[type="absenden"] {
            height: 15px;
            width: 60px;
        }
        input[type="registrieren"] {
            height: 15px;
            width: 70px;
        }

        input[type="passwort"] {
            height: 25px;
            width: 60px;
        }

        input[type="absenden"] {
            height: 25px;
            width: 60px;
        }
    </style>
</head>

<body>
    <h1>GFN - Materialverwaltung</h1>
    <form action="" method="post">
        <label for="benutzername: ">Benutzername:</label>
        <input type="text" id="username" name="username">
        <br>
        <br>
        <label for="email: ">E-Mail:</label>
        <input type="text" id="email" name="email">
        <br>
        <br>
        <label for="passwort: ">Passwort:</label>
        <input type="password" id="password" name="password">
        <br>
        <br>
        <input type="absenden" value="absenden">
        <input type="registrieren" value="registrieren">
    </form>
</body>

</html>