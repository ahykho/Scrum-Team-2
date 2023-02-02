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
	
		<link rel="stylesheet" href="CSS/css.css">
      <link rel="stylesheet" type="text/css" href="CSS/styles.css" />
      <script src="https://kit.fontawesome.com/9924700cc6.js" crossorigin="anonymous"></script>
      <link href="https://fonts.cdnfonts.com/css/star-wars" rel="stylesheet">
	
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
      for(let i=0;i<6000;i++) {
        star = new THREE.Vector3(
          Math.random() * 600 - 300,
          Math.random() * 600 - 300,
          Math.random() * 600 - 300
        );
        star.velocity = 0;
        star.acceleration = 0.02;
        starGeo.vertices.push(star);
      }

      let sprite = new THREE.TextureLoader().load( 'CSS/star.png' );
      let starMaterial = new THREE.PointsMaterial({
        color: 0xaaaaaa,
        size: 0.7,
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