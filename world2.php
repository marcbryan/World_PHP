<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Continentes</title>
  </head>
  <body>
    <form action="world2.php" method="post">
      <select name="continent">
        <?php
          $hostname = "localhost";
          $dbname = "world";
          $username = "admin";
          $pw = "@dmIn123";
          $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);

          $query = $pdo->prepare("SELECT DISTINCT continent FROM country");
          $query -> execute();

          while ($row = $query -> fetch()) {
            echo "<option>".$row['continent']."</option>";
          }

          unset($pdo);
          unset($query);
        ?>
      </select>
      <input type="submit" name="send" value="Seleccionar">
    </form>
    <ul>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["continent"])) {
          $continent = $_POST["continent"];
          $hostname = "localhost";
          $dbname = "world";
          $username = "admin";
          $pw = "@dmIn123";
          $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $pw);

          $query = $pdo->prepare("SELECT name, population FROM country WHERE continent = '$continent'");
          $query -> execute();
          $total_pop = 0;
          while ($row = $query -> fetch()) {
            echo "<li>".$row['name']." - ".$row['population']." hab.</li>";
            $total_pop += $row['population'];
          }
          echo "<p>Población de ".$continent.": ".$total_pop." hab.</p>";

          unset($pdo);
          unset($query);
        }
      ?>
    </ul>
  </body>
</html>
