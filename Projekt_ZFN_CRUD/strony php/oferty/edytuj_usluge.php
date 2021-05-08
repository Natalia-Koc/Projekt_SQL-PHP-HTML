<?php 
session_start()
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>ZFN</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.CSS">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
  </head>
  <body>
    <section>
      <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
        <?php $id = $_GET["id"]; ?>
        <form action="edytuj_usluge_bazaDanych.php?id= <?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <?php
          require "../../baza danych/config/config.php";
          require "../../baza danych/lib/lib.php";
          $connect = new PDO($servername, $username, $password, $options);

          $sql = "SELECT * FROM uslugi u, zwierzaki z WHERE u.zwierzak_id = z.zwierzak_id AND u.usluga_id =".$_GET["id"];

          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
          $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              foreach ($result as $row) {
                echo "
                  <p>Zwierzak: ".$row["nazwa"]."</p>
                  <p>Usługa: <textarea rows='1' cols='30' name='nazwa_usluga'>".$row["nazwa_uslugi"]."</textarea></p>
                  <p>Data start: <input id='usluga_start' type='datetime' name='usluga_start' value='".$row["usluga_start"]."'></p>
                  <p>Data stop: <input id='usluga_stop' type='datetime' name='usluga_stop' value='".$row["usluga_stop"]."'></p>
                  <p>Cena: <input id='cena' type='number' name='cena' value='".$row["cena"]."'></p><br>";
              }
            }
        ?></div>
        <input id='przycisk' type='submit' name='submit' value='Zapisz'>
        </form>
        <form action="aktualne.php" style="text-align: left">
          <input id="przycisk" type="submit" name="submit" value="powrót">
        </form>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>

</body>
</html>