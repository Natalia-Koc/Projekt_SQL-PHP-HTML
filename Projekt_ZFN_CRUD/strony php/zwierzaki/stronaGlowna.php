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

      <header>
        <table>
          <tr><button><a href="../moje konto/moje_konto.php"> Moje konto </a></button></tr>
          <tr><button><a href="../oferty/historia.php"> Historia </a></button></tr>
          <tr><button><a href="../oferty/aktualne.php"> Aktualne </a></button></tr>
          <tr><button><a href="../oferty/oferty_powiadomienia.php"> Powiadomienia </a></button></tr>
          <tr><button><a href="stronaGlowna.php"> Strona główna </a></button></tr>
          <tr><button><a href="../Logowanie/logowanie_rejestracja.php"> Wyloguj się </a></button></tr>
        </table>
      </header>

      <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
         <?php
          require "../../baza danych/config/config.php";
          require "../../baza danych/lib/lib.php";
          $connect = new PDO($servername, $username, $password, $options);

            $sql = "SELECT * FROM uslugi u, zwierzaki z 
              WHERE u.zwierzak_id = z.zwierzak_id 
                AND u.opiekun_id IS NULL 
                AND u.wlasciciel_id !=".$_SESSION["id"];

            $statement = $connect->prepare($sql);
            $statement->execute();
          ?><div style="text-align: center"><?php 
            $result = $statement->fetchAll();
              if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    echo "<a href='zwierzak_info.php?id=".$row["zwierzak_id"]."'><img src='../../obrazy/zdjeciaZwierzakow/".$row["zdjecie"]."' alt='".$row["nazwa"]."' height='210' style='margin:5px;'></a>";
                }
              }
          ?></div>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>