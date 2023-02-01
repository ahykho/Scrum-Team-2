<!DOCTYPE html>

<?php
	session_unset();
        session_start();
?>
<!-- AUTHOR: F. -->
<!-- DESIGNANPASSUNG NOETIG -->
											<!-- LOGIN -->

                                                
                                                <?php
                                                    if (!isset($_SESSION['benutzer'])){
                                                        echo "<h4>Login f&uuml;r Kunden:</h4>";
                                                        echo "<p><a href='html/login.php' class='button'><font color='#172121'>Einloggen</font></a></p>";
						
						
                                                        // REGISTRATION 
                                                        echo "<h4>Noch kein Kunde?</h4>";
                                                        echo "<p><a href='html/reg.php' class='button'><font color='#172121'>Registrieren</font></a></p>";
                                                    }
                                                ?>
                                                
                                                <!-- LOGOUT NUR FUER EINGELOGGTE USER -->
                                                <?php
                                                    if(isset($_SESSION['benutzer'])){

                                                            
                                                        $connect = new mysqli("localhost", "root", "", "xyz");

                                                                                                                 
                                                        $sqlstmt = "SELECT benutzername FROM benutzer WHERE benutzerID = " . $_SESSION['benutzer'];
                                                            
                                                        // echo $sqlstmt;
                                                            
                                                        $query = mysqli_query($connect,$sqlstmt);
                                                            
                                                        while($x=mysqli_fetch_array($query)){
                                                            $username = $x['benutzername'];
                                                                    echo "<h3>Willkommen " . $username . "!</h3>";
                                                        }
                                                        
                                                        
                                                        // ARTIKEL AENDERN BUTTON
                                                        if($_SESSION['benutzer'] == 1){
                                                                    echo "<p><a href='html/bearb.php' class='button'><font color='#172121'>Artikel bearbeiten</font></a></p>";
                                                               }
                                                        
                                                        
                                                        // LOGOUT BUTTON
                                                        echo "<p><a href='html/logout.php' class='button'><font color='#172121'>Logout</font></a></p>";
                                                            if(isset($_GET['logout'])){
                                                               session_start();
                                                               session_unset();
                                                            }
                                                        }else{
                                                            echo "Bitte loggen Sie sich ein oder registrieren Sie sich.";
                                                            
                                                    }
                                                ?>
