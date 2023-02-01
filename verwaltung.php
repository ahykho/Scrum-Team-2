<?php
    session_start();
    if (isset($_SESSION['user'])) {
        echo "Willkommen $_SESSION[vorname] $_SESSION[nachname]";
    } else {
        session_unset();
        session_destroy();
        header("location: login.php");
        exit();
    }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <style>
    </style>
</head>

<body>
    <h1>GFN - Materialverwaltung</h1>
    <form>
    </form>
</body>

</html>