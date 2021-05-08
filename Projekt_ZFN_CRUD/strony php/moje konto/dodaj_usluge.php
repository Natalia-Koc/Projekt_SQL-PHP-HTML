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
        <form action='dodaj_usluge_bazaDanych.php' method='post' enctype='multipart/form-data'>
          <p>Nazwa usługi: <input type='text' name='nazwa_uslugi' id='nazwa_uslugi'></p>
          <p>Data rozpoczęcia usługi: <input id='usluga_start' type='datetime-local' name='usluga_start'></p>
          <p>Data zakończenia usługi: <input id='usluga_stop' type='datetime-local' name='usluga_stop'></p>
          <p>cena: <input id='cena' type='number' name='cena'></p>
          Zwierzak: 
          <select id="zwierzak_id" type="number" name="zwierzak_id">
            <?php 
              require "../../baza danych/config/config.php";
              require "../../baza danych/lib/lib.php";
              $connect = new PDO($servername, $username, $password, $options);
              // Check connection
              if ($connect->connect_error) {
                  die("Connection failed: " . $connect->connect_error);
              } 

              $sql = "SELECT * FROM zwierzaki z, opiekun_zwierze op WHERE z.zwierzak_id = op.zwierzak_id AND op.opiekun_id =".$_SESSION["id"];
              $statement = $connect->prepare($sql);
              $statement->execute();
              $result = $statement->fetchAll();
              if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                  echo "<option value='".$row["zwierzak_id"]."'> ".$row["nazwa"]." </option>";
                }
              }
            ?>
          </select>
          <br><br>
          <input id='przycisk' type='submit' name='submit' value='Zapisz'>
        </form>
        <form action="moje_konto.php" style="text-align: left">
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