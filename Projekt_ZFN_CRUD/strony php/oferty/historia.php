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

          $sql = "SELECT  u.*, z.*, op.*, g.*, (SELECT round(AVG(ocena)) FROM ocena) as sr 
            FROM  uslugi u, zwierzaki z, opiekun op, gatunek g
            WHERE g.gatunek_id = z.gatunek_id
              AND z.zwierzak_id = u.zwierzak_id 
              AND u.usluga_stop < now()
              AND ((op.opiekun_id = u.wlasciciel_id AND u.opiekun_id = ".$_SESSION["id"].")
              OR (op.opiekun_id = u.opiekun_id AND u.wlasciciel_id = ".$_SESSION["id"]."))";

          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              echo "
              <table style='width:96%; margin-left:2%'>
                <tr><em> Historia wszystkich zakończonych już operacji ◕‿◕ <br><br></em></tr>
                <tr style='background-color: PaleGreen'>
                  <th> właściciel </th>
                  <th> opiekun </th>
                  <th> zwierzak </th>
                  <th> usługa </th>
                  <th> data i czas </th>
                  <th> cena </th>
                </tr>";
              foreach ($result as $row) {
                echo 
                "<tr style='text-align:center'>";
                  if($row["wlasciciel_id"] == $_SESSION["id"] && $row["opiekun_id"] != $_SESSION["id"]) {
                    echo "<td> JA </td>
                    <td> 
                      ".$row["nick"]."<br>
                      ".$row["imie"]." ".$row["nazwisko"]."<br>
                      tel. ".$row["telefon"]."<br>
                      ".$row["sr"]." <img src='../../obrazy/ikony/star.png' style='width:20px;'>
                    </td>";
                  } else {
                    echo "
                    <td> 
                      ".$row["nick"]."<br>
                      ".$row["imie"]." ".$row["nazwisko"]."<br>
                      tel. ".$row["telefon"]."<br>
                      ".$row["sr"]." <img src='../../obrazy/ikony/star.png' style='width:20px;'>
                    </td>
                    <td> JA </td>";
                  } 
                  echo "
                  <td> 
                    Imie - ".$row["nazwa"]."<br>
                    Gatunek - ".$row["gatunek"]."<br>
                    Rasa - ".$row["rasa"]."
                  </td>
                  <td> ".$row["nazwa_uslugi"]." </td>
                  <td> start - ".$row["usluga_start"]." <br>stop - ".$row["usluga_stop"]." </td>
                  <td> ".$row["cena"]." zł </td>
                </tr>";
              }
              echo "</table>";
            } else {
              echo "<em> Brak spraw starej daty  ¯\_(ツ)_/¯` <br></em>";
            }
          ?> </div>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>