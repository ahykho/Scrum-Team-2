<?php
$con = new mysqli("localhost", "root", "", "inventarisierung");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['search'])) {
  $search = $_GET['search'];
  $sql = "SELECT * FROM hardware WHERE seriennummer LIKE '%$search%' OR hersteller LIKE '%$search%' OR kaufdatum LIKE '%$search%' OR garantieablaufdatum LIKE '%$search%' OR betriebssystem LIKE '%$search%' OR zubehoer LIKE '%$search%' OR ausgegebenVon LIKE '%$search%' OR ausgegebenAn LIKE '%$search%' OR ausgabedatum LIKE '%$search%' OR rueckgabedatum LIKE '%$search%' OR standort LIKE '%$search%' OR zustand LIKE '%$search%' OR verfuegbarkeit LIKE '%$search%'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      echo "seriennummer: " . $row["seriennummer"] . " - hersteller: " . $row["hersteller"] . " - kaufdatum: " . $row["kaufdatum"] . " - garantieablaufdatum: " . $row["garantieablaufdatum"] . " - betriebssystem: " . $row["betriebssystem"] . " - zubehoer: " . $row["zubehoer"] . " - ausgegebenVon: " . $row["ausgegebenVon"] . " - ausgegebenAn: " . $row["ausgegebenAn"] . " - ausgabedatum: " . $row["ausgabedatum"] . " - rueckgabedatum: " . $row["rueckgabedatum"] . " - standort: " . $row["standort"] . " - zustand: " . $row["zustand"] . " - verfuegbarkeit: " . $row["verfuegbarkeit"] . "<br>";
    }
  } else {
    echo "No results found.";
  }
}

$conn->close();
?>

<!-- HTML form -->
<form action="search.php" method="get">
  <input type="text" name="search" placeholder="Search">
  <button type="submit">Submit</button>
</form>
