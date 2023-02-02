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
	
	
	<link rel="stylesheet" href="CSS/css.css">
      <link rel="stylesheet" type="text/css" href="CSS/styles.css" />
      <script src="https://kit.fontawesome.com/9924700cc6.js" crossorigin="anonymous"></script>

      <link href="https://fonts.cdnfonts.com/css/star-wars" rel="stylesheet">
	
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
			header("location: login.php");
            session_destroy();
            echo "Anmeldung fehlgeschlagen. Bitte registrieren Sie sich.<br>";
        }
        $connect->close();
    }
    ?>
	
	
	
	<script src="JavaScript/three.min.js"></script>
    <script>
    let scene, camera, renderer, stars, starGeo;

    function init() {

      scene = new THREE.Scene();

      camera = new THREE.PerspectiveCamera(60,window.innerWidth / window.innerHeight, 1, 1000);
      camera.position.z = 1;
      camera.rotation.x = Math.PI/2;

      renderer = new THREE.WebGLRenderer();
      renderer.setSize(window.innerWidth, window.innerHeight);
      document.body.appendChild(renderer.domElement);

      starGeo = new THREE.Geometry();
      for(let i=0;i<1000;i++) {
        star = new THREE.Vector3(
          Math.random() * 600 - 300,
          Math.random() * 600 - 300,
          Math.random() * 600 - 300
        );
        star.velocity = 0;
        star.acceleration = 0.003;
        starGeo.vertices.push(star);
      }

      let sprite = new THREE.TextureLoader().load( 'CSS/scrum2.png' );
      let starMaterial = new THREE.PointsMaterial({
        color: 0xaaaaaa,
        size: 7,
        map: sprite
      });

      stars = new THREE.Points(starGeo,starMaterial);
      scene.add(stars);

      window.addEventListener("resize", onWindowResize, false);

      animate(); 
    }
    function onWindowResize() {
        camera.aspect = window.innerWidth / window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth, window.innerHeight);
      }
    function animate() {
      starGeo.vertices.forEach(p => {
        p.velocity += p.acceleration
        p.y -= p.velocity;
        
        if (p.y < -200) {
          p.y = 200;
          p.velocity = 0;
        }
      });
      starGeo.verticesNeedUpdate = true;
      stars.rotation.y +=0.002;
    
      renderer.render(scene, camera);
      requestAnimationFrame(animate);
    }
    init();
    
    </script>
	
	
	
  </body>
</html>