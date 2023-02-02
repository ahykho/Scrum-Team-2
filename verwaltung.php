
<!DOCTYPE html>
<?php
    session_unset();
    session_start();
    ?>

<html>

<head>
    <title>Materialverwaltung</title>

    <link href="inventartools/css.css" rel="stylesheet" type="text/css"/> 

</head>

<body>
    <h1>Willkommen zur Materialverwaltung</h1>

    <?php
    
    if (isset($_SESSION['id'])) {
        
        $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                  
        $sqlstmt = "SELECT vorname FROM accounts WHERE id = " . $_SESSION['id'];
            
        //echo $sqlstmt;
            
        $query = mysqli_query($connect,$sqlstmt);
            
        while($x=mysqli_fetch_array($query)){
            $username = $x['vorname'];
                    echo "<h2>Willkommen " . $username . "!</h2>";
        }


    } else {
        session_unset();
        session_destroy();
        header("location: login.php");
        exit();
    }
?>


<!-- PROFIL -->
<table>

<tr><h3>Ihr Profil</h3></tr>
    <tr></tr>
    <tr>
        <td>Name</td>
                                <td><?php
    
                                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                            
                                    $sqlstmt = "SELECT vorname, nachname FROM accounts WHERE id = " . $_SESSION['id'];
                                    
                                    $query = mysqli_query($connect,$sqlstmt);
                                        
                                    while($x=mysqli_fetch_array($query)){
                                        $vorname = $x['vorname'];
                                        $nachname = $x['nachname'];

                                                echo $vorname . " " . $nachname;
                                            
                                    }
                                ?></td>
    </tr>

    <tr>
        <td>Adresse</td>
                                <td><?php
                                
                                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                            
                                    $sqlstmt = "SELECT strasse, plz, ort FROM accounts WHERE id = " . $_SESSION['id'];
                                    
                                    $query = mysqli_query($connect,$sqlstmt);
                                        
                                    while($x=mysqli_fetch_array($query)){
                                        $strasse = $x['strasse'];
                                        $plz = $x['plz'];
                                        $ort = $x['ort'];

                                                echo $strasse . ", " . $plz . " " . $ort;
                                            
                                    }
                                ?></td>

    </tr>

    <tr>
        <td>E-Mail</td>
                                <td><?php
                                    
                                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                            
                                    $sqlstmt = "SELECT email FROM accounts WHERE id = " . $_SESSION['id'];
                                    
                                    $query = mysqli_query($connect,$sqlstmt);
                                        
                                    while($x=mysqli_fetch_array($query)){
                                        $email = $x['email'];

                                                echo $email;
                                            
                                    }
                                ?></td>
    </tr>

    <tr>
        <td>Rolle</td>
                                <td><?php
                                    
                                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                            
                                    $sqlstmt = "SELECT rolle FROM accounts WHERE id = " . $_SESSION['id'];
                                    
                                    $query = mysqli_query($connect,$sqlstmt);
                                        
                                    while($x=mysqli_fetch_array($query)){
                                        $rolle = $x['rolle'];

                                                echo $rolle;
                                            
                                    }
                                ?></td>
    </tr>

    <tr>
        <td>Standort</td>
                                <td><?php
                                    
                                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                            
                                    $sqlstmt = "SELECT standort FROM accounts WHERE id = " . $_SESSION['id'];
                                    
                                    $query = mysqli_query($connect,$sqlstmt);
                                        
                                    while($x=mysqli_fetch_array($query)){
                                        $standort = $x['standort'];

                                                echo $standort;
                                            
                                    }
                                ?></td>
    </tr>

    <tr>
        <td>Einstellungsdatum</td>
                                <td><?php
                                    
                                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                            
                                    $sqlstmt = "SELECT einstellungsdatum FROM accounts WHERE id = " . $_SESSION['id'];
                                    
                                    $query = mysqli_query($connect,$sqlstmt);
                                        
                                    while($x=mysqli_fetch_array($query)){
                                        $einstellungsdatum = $x['einstellungsdatum'];

                                                echo $einstellungsdatum;
                                            
                                    }
                                ?></td>
    </tr>
        
                                        <!-- TODO -->
    <tr>
    <td>
    <p><button type="submit" name="logout"><a href="login.php" class="button" name="logout">Logout</button></a></p>
    <?php 
                                                            if(isset($_GET['logout'])){
                                                               session_start();
                                                               session_unset();
                                                            }
                                                            ?>
    </td>
                               <td><button type="submit" name="changedata">Daten &auml;ndern</button></td></tr>
 
</table>


<p>
<!-- WAREN -->
<h2>Warenauswahl</h2>


<?php
                                     
                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                    
                    $sqlstmt = "SELECT rolle FROM accounts WHERE id = " . $_SESSION['id'];
                                            
                    $query = mysqli_query($connect,$sqlstmt);
                             
                    while($x=mysqli_fetch_array($query)){
                        $rolle = $x['rolle'];
                                echo "Sie sind " . $rolle;
                                echo "<p></p>";
                    }

                    if($rolle == "Mitarbeiter") {
                        echo "Zugriff: Mitarbeiter";

                    } 
                    else {
                        if($rolle == "Student")
                        echo "Zugriff: Student";

                    }
                
        ?>
<p></p>

<table cellpadding="1em" cellspacing="5em" border="1px">
<tr>
    <td>Seriennummer </td>  
    <td>Hersteller</td>
    <td>Betriebssystem</td>
    <td>Garantiedatum</td>
    <td>Kaufdatum</td>
    <td>Standort</td>
    <td>Verf&uuml;gbarkeit</td>
    <td>Zubeh&ouml;r</td>
    <td>Zustand</td>
    <td>Ausgabedatum</td>
    <td>Ausgegeben von</td>
    <td>Ausgegeben an</td>
    <td>R&uuml;ckgabedatum</td>
</tr>

<!-- ---------------------------------------------------------------------------------------------------------------- -->

    <tr>
        <td>
        <?php
                    // ---------- SERIENNUMMER -----------------------------------------------------                   
                    $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                    
                    $sqlstmt = "SELECT seriennummer FROM hardware";
                                            
                    $query = mysqli_query($connect,$sqlstmt);
                                                
                    while($x=mysqli_fetch_array($query)){
                        $seriennr = $x['seriennummer'];
                        echo $seriennr . "<br>"; 
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- HERSTELLER ---------------------------------------------------------------                      
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT hersteller FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $hersteller = $x['hersteller'];
                        echo $hersteller . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- BETRIEBSSYSTEM ---------------------------------------------------------                         
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT betriebssystem FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $betriebssystem = $x['betriebssystem'];
                        echo $betriebssystem . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>


        <td>
        <?php     // ---- GARANTIEDATUM ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT garantieablaufdatum FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $garantiedatum = $x['garantieablaufdatum'];
                        echo $garantiedatum . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- KAUFDATUM ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT kaufdatum FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $kaufdatum = $x['kaufdatum'];
                        echo $kaufdatum . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- STANDORT ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT standort FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $standort = $x['standort'];
                        echo $standort . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- VERFUEGBARKEIT ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT verfuegbarkeit FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $verfuegbarkeit = $x['verfuegbarkeit'];
                        echo $verfuegbarkeit . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- ZUEBEHOER ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT zubehoer FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $zubehoer = $x['zubehoer'];
                        echo $zubehoer . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>


        <td>
        <?php   // ---- ZUSTAND ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT zustand FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $zustand = $x['zustand'];
                        echo $zustand . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>


        <td>
        <?php   // ---- AUSGABEDATUM ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT ausgabedatum FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $ausgabedatum = $x['ausgabedatum'];
                        echo $ausgabedatum . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>


        
        <td>
        <?php   // ---- AUSGEGEBEN VON ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT ausgegebenVon FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $ausgegebenVon = $x['ausgegebenVon'];
                        echo $ausgegebenVon . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>


        <td>
        <?php   // ---- AUSGEGEBEN AN ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT ausgegebenAn FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $ausgegebenAn = $x['ausgegebenAn'];
                        echo $ausgegebenAn . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>

        <td>
        <?php   // ---- RUECKGABEDSTUM ---------------------------------------------------------                            
                $connect = new mysqli("localhost", "root", "", "inventarisierung");
                                                                                                                                            
                $sqlstmt = "SELECT rueckgabedatum FROM hardware";
                                                                    
                $query = mysqli_query($connect,$sqlstmt);
                                                                        
                    while($x=mysqli_fetch_array($query)){
                        $rueckgabedatum = $x['rueckgabedatum'];
                        echo $rueckgabedatum . "<br>";
                        echo "<hr>";
                    }
        ?>
        </td>


    </tr>
 </table>





</body>

</html>