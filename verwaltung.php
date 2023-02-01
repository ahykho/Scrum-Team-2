
<!DOCTYPE html>
<?php
    session_unset();
    session_start();
    ?>

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

    <?php
    
    if (isset($_SESSION['id'])) {
        
        $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                  
        $sqlstmt = "SELECT vorname FROM accounts WHERE id = " . $_SESSION['id'];
            
        echo $sqlstmt;
            
        $query = mysqli_query($connect,$sqlstmt);
            
        while($x=mysqli_fetch_array($query)){
            $username = $x['vorname'];
                    echo "<h3>Willkommen " . $username . "!</h3>";
        }



    } else {
        session_unset();
        session_destroy();
        header("location: test.php");
        exit();
    }
?>

</body>

</html>