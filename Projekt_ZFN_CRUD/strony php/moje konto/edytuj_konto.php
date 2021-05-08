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

          $sql = "SELECT * FROM opiekun WHERE opiekun_id =".$_SESSION["id"];

          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
          $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              foreach ($result as $row) {
                echo "
                <form action='edytuj_konto_bazaDanych.php' method='post' enctype='multipart/form-data'>
                  <p>Imię i nazwisko:  
                    <input id='imie' type='text' name='imie' value='".$row["imie"]."'>
                    <input id='nazwisko' type='text' name='nazwisko' value=' ".$row["nazwisko"]."'></p>
                  <p>Nick: <input id='nick' type='text' name='nick' value='".$row["nick"]."'></p>
                  <p>Hasło: <input id='haslo' type='text' name='haslo' value='".$row["haslo"]."'></p><br>
                  <p>Telefon: <input id='telefon' type='text' name='telefon' value='".$row["telefon"]."'></p><br>
                  <p>Adres zamieszkania:
                    <p>miasto <input id='miasto' type='text' name='miasto' value='".$row["miasto"]."'></p>
                    <p>ul. <input id='ulica' type='text' name='ulica' value='".$row["ulica"]."'></p>
                    <p>nr. domu <input id='dom' type='text' name='dom' value='".$row["dom"]."'> / <input id='mieszkanie' type='text' name='mieszkanie' value='".$row["mieszkanie"]."'></p></p>";
              }
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