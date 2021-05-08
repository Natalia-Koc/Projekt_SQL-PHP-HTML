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
          <tr><button><a href="historia.php"> Historia </a></button></tr>
          <tr><button><a href="aktualne.php"> Aktualne </a></button></tr>
          <tr><button><a href="oferty_powiadomienia.php"> Powiadomienia </a></button></tr>
          <tr><button><a href="../zwierzaki/stronaGlowna.php"> Strona główna </a></button></tr>
          <tr><button><a href="../Logowanie/logowanie_rejestracja.php"> Wyloguj się </a></button></tr>
        </table>
      </header>

      <div class="naglowek"><h2>Zwierzoluby z Fajną Nazwą</h2></div>
      <article>
       <?php
        require "../../baza danych/config/config.php";
        require "../../baza danych/lib/lib.php";
        $connect = new PDO($servername, $username, $password, $options);

        $sql = "SELECT o.*, u.*, z.*, op.*, g.*, (SELECT round(AVG(ocena)) FROM ocena) as sr 
          FROM  oferty o, uslugi u, zwierzaki z, opiekun op, gatunek g
          WHERE u.usluga_id = o.o_usluga_id 
            AND g.gatunek_id = z.gatunek_id
            AND z.zwierzak_id = u.zwierzak_id 
            AND op.opiekun_id = o.o_opiekun_id 
            AND o.stan_oferty = 'zatwierdzone'
            AND u.usluga_stop > now()
            AND o.o_wlasciciel_id = ".$_SESSION["id"];

        $statement = $connect->prepare($sql);
        $statement->execute();
        ?><div style="text-align: center"><?php 
          $result = $statement->fetchAll();
          if ($result && $statement->rowCount() > 0) {
            echo "
            <table style='width:90%; margin-left:5%'>
            <tr><p style='text-decoration: underline; font-size: 20px;'>Zgłoszenia, które zaakceptowałem/am: </p></tr>
              <tr style='background-color: PaleGreen'>
                <th> opiekun </th>
                <th> zwierzak </th>
                <th> usługa </th>
                <th> data i czas </th>
                <th> cena </th>
                <th> rezygnuję </th>
              </tr>";
            foreach ($result as $row) {
              echo 
              "
              <tr style='text-align:center'>
                <td> 
                  ".$row["nick"]."<br>
                  ".$row["imie"]." ".$row["nazwisko"]."<br>
                  tel. ".$row["telefon"]."<br>
                  ".$row["sr"]." <img src='../../obrazy/ikony/star.png' style='width:20px;'>
                </td>
                <td> 
                  Imie - ".$row["nazwa"]."<br>
                  Gatunek - ".$row["gatunek"]."<br>
                  Rasa - ".$row["rasa"]."
                </td>
                <td> ".$row["nazwa_uslugi"]." </td>
                <td> ".$row["usluga_start"]." - ".$row["usluga_stop"]." </td>
                <td> ".$row["cena"]." zł </td>
                <td> 
                    <a href='oferta_rezygnuje.php?id={$row["oferty_id"]}'>
                      <img src='../../obrazy/ikony/quit.png' style='width:80px'>
                    </a>
                </td>
              </tr>";
            }
            echo "</table>";
          } else {
            echo "<em> Brak zaakceptowanych przeze mnie zgłoszeń (︶^︶) <br></em>";
          }

          $sql = "SELECT * FROM oferty o, uslugi u, zwierzaki z, opiekun op, gatunek g
            WHERE u.usluga_id = o.o_usluga_id 
              AND g.gatunek_id = z.gatunek_id
              AND z.zwierzak_id = u.zwierzak_id 
              AND op.opiekun_id = o.o_wlasciciel_id 
              AND o.stan_oferty = 'zatwierdzone'
              AND u.usluga_stop > now()
              AND o.o_opiekun_id = ".$_SESSION["id"];
          $statement = $connect->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          if ($result && $statement->rowCount() > 0) {
            echo 
            "<br><br>
            <table style='width:90%; margin-left:5%'>
            <tr><p style='text-decoration: underline; font-size: 20px;'>Zgłoszenia, w których mnie zaakceptowano: </p></tr>
              <tr style='background-color: PaleGreen'>
                <th> właściciel </th>
                <th> zwierzak </th>
                <th> usługa </th>
                <th> data i czas </th>
                <th> zapłata </th>
                <th> rezygnuję </th>
              </tr>";
            foreach ($result as $row) {
              echo "
              <tr>
                <td>
                  ".$row["nick"]."<br>
                  ".$row["imie"]." ".$row["nazwisko"]."<br>
                  tel. ".$row["telefon"]."<br><br>
                  ".$row["miasto"]."<br>
                  ul. ".$row["ulica"]."<br>
                  nr. domu ".$row["dom"];
                  if($row["mieszkanie"] != '0' && $row["mieszkanie"] != null) {
                    echo "/".$row["mieszkanie"];
                  }
                echo "
                </td>
                <td> 
                  Imie - ".$row["nazwa"]."<br>
                  Gatunek - ".$row["gatunek"]."<br>
                  Rasa - ".$row["rasa"]." 
                </td>
                <td> ".$row["nazwa_uslugi"]." </td>
                <td> ".$row["usluga_start"]." - ".$row["usluga_stop"]." </td>
                <td> ".$row["cena"]." zł</td>
                <td> 
                  <a href='oferta_rezygnuje.php?id={$row["oferty_id"]}'>
                    <img src='../../obrazy/ikony/quit.png' style='width:80px'>
                  </a>
                </td>
              </tr>";
            }
            echo "</table>";
          } else {
            echo "<br><em>Brak zgłoszeń, w których mnie zaakceptowano ಠ_ಠ </em>";
          }


          $sql = "SELECT u.*, z.*, g.*
          FROM  uslugi u, zwierzaki z, gatunek g
          WHERE z.zwierzak_id = u.zwierzak_id 
            AND z.gatunek_id = g.gatunek_id
            AND u.usluga_stop > now()
            AND u.opiekun_id IS NULL
            AND u.wlasciciel_id = ".$_SESSION["id"];

          $statement = $connect->prepare($sql);
          $statement->execute();
          $result = $statement->fetchAll();
          if ($result && $statement->rowCount() > 0) {
            echo "
            <table style='width:90%; margin-left:5%'>
            <tr><p style='text-decoration: underline; font-size: 20px;'>Pozostałe, które oczekują na zgłoszenia opiekunów: </p></tr>
              <tr style='background-color: PaleGreen'>
                <th> zwierzak </th>
                <th> usługa </th>
                <th> data i czas </th>
                <th> cena </th>
                <th> edytuj </th>
              </tr>";
            foreach ($result as $row) {
              echo 
              "
              <tr style='text-align:center'>
                <td> 
                  Imie - ".$row["nazwa"]."<br>
                  Gatunek - ".$row["gatunek"]."<br>
                  Rasa - ".$row["rasa"]."
                </td>
                <td> ".$row["nazwa_uslugi"]." </td>
                <td> start - ".$row["usluga_start"]." <br>stop - ".$row["usluga_stop"]." </td>
                <td> ".$row["cena"]." zł </td>
                <td> 
                    <a href='edytuj_usluge.php?id={$row["usluga_id"]}'>
                      <img src='../../obrazy/ikony/edit.png' style='width:30px'>
                    </a>
                </td>
              </tr>";
            }
            echo "</table>";
          }
        ?> </div>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>