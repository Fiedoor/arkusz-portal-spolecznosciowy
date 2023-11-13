<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="UTF-8">
  <title>Panel administratora</title>
  <link rel="stylesheet" href="styl4.css">
</head>

<body>
  <header>
    <h3>Portal społecznościowy-panel administratora</h3>
  </header>
  <main>
    <div id="left">
      <h4>Użytkownicy</h4>
      <?php
      $conn = mysqli_connect('localhost', 'root', '', 'dane4');
      $res1 = mysqli_query($conn, 'SELECT id,imie,nazwisko,rok_urodzenia,zdjecie FROM `osoby` LIMIT 30');
      foreach ($res1 as $row) {
        $wiek = 2023 - $row['rok_urodzenia'];
        echo $row['id'] . '&nbsp' . $row['imie'] . '&nbsp' . $row['nazwisko'] . '&nbsp' . $wiek . ' lat' . '<br>';
      }
      ?>
      <a href="settings.html">Inne ustawienia</a>
    </div>
    <div id='right'>
      <h4>Podaj ID użytkownika</h4>
      <form action="users.php" method="post">
        <input type="number" name="id">
        <input type="submit" value="ZOBACZ">
      </form>
      <hr>
      <?php
      if (isset($_POST['id'])) {
        $id = $_POST['id'];
        $res2 = mysqli_query($conn, "SELECT osoby.id,osoby.imie,osoby.nazwisko,rok_urodzenia,zdjecie,opis,hobby.nazwa FROM `osoby` inner join hobby on Hobby_id=hobby.id where osoby.id=$id;");
        foreach ($res2 as $row2) {
          echo "<h2>" . $id . '&nbsp' . $row2['imie'] . '&nbsp' . $row2['nazwisko'] . '&nbsp' . "</h2>";
          echo "<img src='" . $row2['zdjecie'] . "' alt='" . $id . "'>";
          echo "<p> Rok urodzenia: " . $row2['rok_urodzenia'] . "</p>";
          echo "<p> Opis: " . $row2['opis'] . "</p>";
          echo "<p> Hobby: " . $row2['nazwa'] . "</p>";
        }
      }
      ?>
    </div>
  </main>
  <footer>
    Stronę wykonał: Stanisław Fiedoruk 5J
  </footer>
</body>

</html>