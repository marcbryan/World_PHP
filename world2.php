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

          $query = $pdo->prepare("SELECT name FROM country WHERE continent = '$continent'");
          $query -> execute();

          while ($row = $query -> fetch()) {
            echo "<li>".$row['name']."</li>";
          }

          unset($pdo);
          unset($query);
        }
      ?>
    </ul>
  </body>
</html>
