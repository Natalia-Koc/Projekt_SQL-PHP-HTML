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

  </head>
  <body>

    <section>

      <header>
        <table>
          <tr><button><a href="moje_konto.php"> Moje konto </a></button></tr>
          <tr><button><a href="../oferty/historia.php"> Historia </a></button></tr>
          <tr><button><a href="../oferty/aktualne.php"> Aktualne </a></button></tr>
          <tr><button><a href="../oferty/oferty_powiadomienia.php"> Powiadomienia </a></button></tr>
          <tr><button><a href="../zwierzaki/stronaGlowna.php"> Strona główna </a></button></tr>
          <tr><button><a href="../Logowanie/logowanie_rejestracja.php"> Wyloguj się </a></button></tr>
        </table>
      </header>

      <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
        <button style="padding: 12px 80px; color: black; font-size: 16px; background-color: lightgrey;"><a href="dodaj_usluge.php" style="color: black"> Dodaj nową ofertę </a></button>
         <?php
          require "../../baza danych/config/config.php";
          require "../../baza danych/lib/lib.php";
          $connect = new PDO($servername, $username, $password, $options);

          $sql = "SELECT * FROM opiekun o WHERE o.opiekun_id = ".$_SESSION["id"];
          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              foreach ($result as $row) {
                  echo 
            "<br>
              <table style='width:80%; margin-left:10%'>
                <tr style='background-color: purple'>
                  <th colspan='2'><em style='color:white; font-size: 20px;'> _ Informacje o moim profilu _ </em></th>
                </tr>
                <tr>
                  <td style='background-color: PaleGreen'> Nick </td>
                  <td><br>".$row["nick"]."</td> 
                </tr>
                <tr>
                  <td style='background-color: PaleGreen'> Imię i nazwisko </td>
                  <td><br>".$row["imie"]." ".$row["nazwisko"]."</td> 
                </tr>
                <tr>
                  <td style='background-color: PaleGreen'> Telefon </td>
                  <td><br>".$row["telefon"]."</td> 
                </tr>
                <tr>
                  <td style='background-color: PaleGreen'> Adres zamieszkania </td>
                  <td>
                    <br>Miasto: ".$row["miasto"]."<br>
                    Ulica: ".$row["ulica"]."<br>
                    Numer domu: ".$row["dom"];
                    if($row["mieszkanie"] != '0' && $row["mieszkanie"] != null) {
                      echo "<br>Numer mieszkania: ".$row["mieszkanie"];
                    }
                  echo "
                  </td> 
                </tr>
                <tr style='background-color: PaleGreen'>
                  <th colspan='2'>
                    <a href='edytuj_konto.php'>
                      <img src='../../obrazy/ikony/edit.png' style='width:30px'>
                    </a>
                  </th>
                </tr>
              </table>";
              }
            }

          $sql = "SELECT * FROM opiekun_zwierze oz, opiekun o, zwierzaki z, gatunek g
            WHERE oz.opiekun_id = o.opiekun_id 
              AND g.gatunek_id = z.gatunek_id
              AND oz.zwierzak_id = z.zwierzak_id 
              AND oz.opiekun_id = ".$_SESSION["id"];

          $statement = $connect->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          if ($result && $statement->rowCount() > 0) {
            foreach ($result as $row) {
                echo 
          "<br><br>
            <table style='width:80%; margin-left:10%'>
              <tr style='background-color: SaddleBrown'>
                <th colspan='2'><em style='color:white; font-size: 20px;'> _ Informacje o zwierzaku - ".$row["nazwa"]." _ </em></th>
              </tr>
              <tr>
                <td style='background-color: PaleGreen'> Zdjęcie </td>
                <td><br>";
                if($row["zdjecie"]) {
                  echo "<img style='height:160px' src='../../obrazy/zdjeciaZwierzakow/{$row["zdjecie"]}'>";
                } else {
                  echo " brak zdjęcia ";
                }
                echo "</td> 
              </tr>
              <tr>
                <td style='background-color: PaleGreen'> Gatunek - rasa </td>
                <td><br>".$row["gatunek"]." - ";
                if($row["rasa"]) {
                  echo $row["rasa"];
                } else {
                  echo " brak danych ";
                }
                echo "</td> 
              </tr>
              <tr>
                <td style='background-color: PaleGreen'> Data urodzenia </td>
                <td><br>";
                if($row["data_urodzenia"]) {
                  echo $row["data_urodzenia"];
                } else {
                  echo " brak danych ";
                }
                echo "</td> 
              </tr>
              <tr>
                <td style='background-color: PaleGreen'> Płeć </td>
                <td><br>";
                  if($row["plec"] == 'k') {
                    echo "żeńska";
                  } else if($row["plec"] == 'm') {
                    echo "męska";
                  } else {
                    echo $row["plec"];
                  }
                echo "
                </td> 
              </tr>
              <tr>
                <td style='background-color: PaleGreen'> Opis </td>";
                  if($row["opis"]) {
                    echo "<td style='width:70%'><br>".$row["opis"];
                  } else {
                    echo "<td><br>brak opisu";
                  }
                echo "
                </td> 
              </tr>
              <tr style='background-color: PaleGreen'>
                <th colspan='2'>
                  <a href='edytuj_zwierzaka.php?id={$row["zwierzak_id"]}'>
                    <img src='../../obrazy/ikony/edit.png' style='width:30px'>
                  </a>
                  <a href='usun_zwierzaka_bazaDanych.php?id={$row["zwierzak_id"]}'>
                    <img src='../../obrazy/ikony/delete.png' style='width:31px'>
                  </a>
                </th>
              </tr>
            </table>";
            }
          }
          ?> </div>
        <br><button style="padding: 12px 80px; color: black; font-size: 16px; background-color: lightgrey;"><a href="dodaj_zwierzaka.php" style="color: black"> Dodaj zwierzaka </a></button>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>