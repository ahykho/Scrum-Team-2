<?php
$con = new mysqli("localhost", "root", "", "inventarisierung");

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

if(isset($_GET['search'])){
$search = $_GET['search'];
$query = "SELECT * FROM accounts WHERE firstname LIKE '%$search%' OR lastname LIKE '%$search%' OR email LIKE '%$search%'";
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
while($row = mysqli_fetch_array($result)){
echo "Last Name: ".$row['lastname']."<br>";
echo "Street: ".$row['street']."<br>";
echo "Zipcode: ".$row['zipcode']."<br>";
echo "City: ".$row['city']."<br>";
echo "Employee Number: ".$row['employeenumber']."<br>";
echo "Email: ".$row['email']."<br>";
echo "Location: ".$row['location']."<br>";
echo "Role: ".$row['rolle']."<br>";
echo "Hire Date: ".$row['hiredate']."<br>";
echo "Password: ".$row['password']."<br><br>";
}
} else {
echo "No results found.";
}
}

$conn->close();
?>

<html>
<head>
  <style>
      .search-form {
        display: flex;
        flex-direction: column;
        align-items: center;
      }
      .form-control {
        margin: 1em 0;
      }
      .form-control label {
        display: block;
        text-align: left;
      }
      .form-control input {
        padding: 0.5em;
        font-size: 1em;
        width: 100%;
      }
    </style>
  <link rel="stylesheet" href="css.css">
  <link href="https://fonts.cdnfonts.com/css/star-wars" rel="stylesheet">
</head>
<body>
<form class="search-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="GET">
  <div class="form-control">
    <label for="search_term">Search:</label>
    <input type="text" id="search_term" name="search_term">
  </div>
  <button type="submit" name="search">Search</button>
</form>