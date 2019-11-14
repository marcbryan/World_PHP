<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Seleccionador de paises</title>
    <style>
      p {
        margin-left: 5px;
      }
    </style>
  </head>
  <body>
    <form action="world.php" method="post">
      <select id="despleg" name="country">
        <?php
          $conn = mysqli_connect('localhost','admin','@dmIn123');
          mysqli_select_db($conn, 'world');
          $query = "SELECT name, code FROM country;";
          $result = mysqli_query($conn, $query);
          if ($result) {
            while($row = mysqli_fetch_assoc($result)) {
              echo "<option>".$row['name']."</option>";
            }
          }
         ?>
      </select>
      <input type="submit" name="send" value="Seleccionar">
    </form>
    <?php
      if ($_SERVER["REQUEST_METHOD"] == "POST" and isset($_POST["country"])) {
        $conn = mysqli_connect('localhost','admin','@dmIn123');
        mysqli_select_db($conn, 'world');
        $query = "select c.Name, ct.Name, c.Code from country c, city ct where c.Code = ct.CountryCode and c.Name = '".$_POST['country']."';";
        $result = mysqli_query($conn, $query);
        if ($result) {
          while($row = mysqli_fetch_assoc($result)) {
            $img = "<img src='gif/".strtolower($row['Code']).".gif'/>";
            echo "<p>".$row['Name']."</p>";
          }
        }
      }
     ?>
  </body>
</html>
