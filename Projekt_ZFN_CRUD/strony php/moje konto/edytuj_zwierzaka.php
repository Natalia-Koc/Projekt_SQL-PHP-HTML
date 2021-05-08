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
        <?php
          require "../../baza danych/config/config.php";
          require "../../baza danych/lib/lib.php";
          $connect = new PDO($servername, $username, $password, $options);

          $sql = "SELECT * FROM zwierzaki z, gatunek g, opiekun_zwierze op 
            WHERE z.gatunek_id = g.gatunek_id
              AND z.zwierzak_id = op.zwierzak_id
              AND z.zwierzak_id = ".$_GET["id"]."
              AND op.opiekun_id =".$_SESSION["id"];

          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
          $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              foreach ($result as $row) {
                echo "
                <form action='edytuj_zwierzaka_bazaDanych.php?id={$row["gatunek_id"]}' method='post' enctype='multipart/form-data'>
                  <img src='../../obrazy/zdjeciaZwierzakow/".$row["zdjecie"]."' style='width:45%'><br>
                    <input type='file' name='fileToUpload' id='fileToUpload'><br>
                  <p>Imie: <input id='nazwa' type='text' name='nazwa' value='".$row["nazwa"]."'></p>
                  <p>Gatunek - <input id='gatunek' type='text' name='gatunek' value='".$row["gatunek"]."'>
                    Rasa - <input id='rasa' type='text' name='rasa' value='".$row["rasa"]."'>
                    Płeć - <input id='plec' type='text' name='plec' value='".$row["plec"]."'></p>
                  <p>Data urodzenia: <input id='data_urodzenia' type='date' name='data_urodzenia' value='".$row["data_urodzenia"]."'></p>
                  <p>Opis: <textarea style='width:60%' name='opis'>".$row["opis"]."</textarea></p>
              ";}
            }
        ?></div>
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