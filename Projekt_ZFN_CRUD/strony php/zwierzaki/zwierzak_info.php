<?php
session_start()
?>
<!DOCTYPE html>
<html lang="pl">
  <head>
    <title>ZFN</title>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../style.CSS">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <style>
      tr:nth-child(even){background-color: #f2f2f2}
      td,th {padding: 4px;}
    </style>
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
          $zwierzak_id = $_GET["id"];

          $sql = "SELECT * FROM zwierzaki z, gatunek g, opiekun o, opiekun_zwierze oz 
            WHERE o.opiekun_id = oz.opiekun_id 
              AND oz.zwierzak_id = z.zwierzak_id 
              AND z.gatunek_id = g.gatunek_id 
              AND z.zwierzak_id =".$zwierzak_id;

          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
            $result = $statement->fetchAll();
              if ($result && $statement->rowCount() > 0) {
                foreach ($result as $row) {
                    echo 
              "<br><br>
                <table style='width:80%; margin-left:10%'>
                  <img style='height:400px' src='../../obrazy/zdjeciaZwierzakow/{$row["zdjecie"]}'>
                  <p style='font-style: oblique; font-size: 19px;'><em style='text-decoration: underline; font-size: 22px;'> ".$row["nazwa"]."</em>";
                  if($row["opis"] != null) {
                    echo " - ".$row["opis"]."</p>";
                  } else {
                    echo "</p>";
                  }
                  echo "<tr style='background-color: PaleGreen'>
                    <th> gatunek </th>
                    <th> rasa </th>
                    <th> data urodzenia </th>
                    <th> płeć </th>
                    <th> miasto </th>
                    <th> ulica </th>
                  </tr>
                  <tr>
                    <td>".$row["gatunek"]."</td>";
                    if($row["rasa"]) {
                      echo "<td>".$row["rasa"]."</td>";
                    } else {
                      echo "<td> - </td>";
                    }
                    if($row["data_urodzenia"]) {
                      echo "<td>".$row["data_urodzenia"]."</td>";
                    } else {
                      echo "<td> - </td>";
                    }
                    if($row["plec"] == 'k') {
                      echo "<td> żeńska </td>";
                    } else if($row["plec"] == 'm') {
                      echo "<td> męska </td>";
                    } else {
                      echo "<td>".$row["plec"]."</td>";
                    }
                    echo "
                    <td> ".$row["miasto"]." </td>
                    <td> ".$row["ulica"]." </td>
                  </tr>
                </table>";
                }
              }

          $sql2 = "SELECT * FROM uslugi u, opiekun o 
            WHERE o.opiekun_id = u.wlasciciel_id 
              AND u.zwierzak_id = $zwierzak_id 
              AND u.opiekun_id IS NULL";

          $statement = $connect->prepare($sql2);
          $statement->execute();
          $result = $statement->fetchAll();
          if ($result && $statement->rowCount() > 0) {
            echo "<br><br> <table style='width:80%; margin-left:10%;'>
                      <tr style='background-color: PaleGreen;'><th style='padding: 8px;'> Oferta zwierzaka </th></tr>";
            foreach ($result as $row) {
              echo 
                "<tr> <td> Właściciel - ".$row["nick"]." </td> </tr>
                <tr> <td> Typ uslugi - ".$row["nazwa_uslugi"]." </td> </tr>
                <tr> <td> Data i czas rozpoczęcia - ".$row["usluga_start"]." </td> </tr>
                <tr> <td> Data i czas zakończenia - ";
                if($row["usluga_stop"] != null) {
                  echo $row["usluga_stop"]." </td></tr>";
                } else {
                  echo "do ustalenia </td></tr>";
                }
              echo "
                <tr> <td> Oferowana zapłata - ".$row["cena"]." zł</td> </tr>
                </table>";
            }
          }

          $sql3 = "SELECT * FROM oferty o, uslugi u 
            WHERE o.o_usluga_id = u.usluga_id 
              AND u.zwierzak_id = $zwierzak_id 
              AND o.o_opiekun_id =".$_SESSION["id"];
              
          $statement = $connect->prepare($sql3);
          $statement->execute();
          $result = $statement->fetchAll();
          if ($result && $statement->rowCount() > 0) {
            echo "<p style='text-align: right; margin-right: 16%'><button> Oferta przyjęta </a></button></p>";
          } else {
            ?><div style='text-align: right; margin-right: 15%'><?php
              echo 
              "<form method='post' action='../oferty/oferta_wyslana.php?usluga={$row["usluga_id"]}'>
                <br><br>Dodatkowe informacje:
                <br><textarea style='width:60%' name='wiadomosc'></textarea><br>
                <button id='przeslij'> Przyjmuję ofertę! </button>
                <br><br>
              </form>";
            ?></div><?php
          }
          ?> </div>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>