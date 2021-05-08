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

          $sql = "SELECT o.*, u.*, z.*, op.*, (SELECT round(AVG(ocena)) FROM ocena) as sr 
            FROM  oferty o, uslugi u, zwierzaki z, opiekun op 
            WHERE u.usluga_id = o.o_usluga_id 
              AND z.zwierzak_id = u.zwierzak_id 
              AND op.opiekun_id = o.o_opiekun_id 
              AND (o.stan_oferty = 'oczekuje na akceptacje' OR o.stan_oferty = 'rezygnacja')
              AND o.o_wlasciciel_id = ".$_SESSION["id"];

          $statement = $connect->prepare($sql);
          $statement->execute();
          ?><div style="text-align: center"><?php 
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              echo "
              <table style='width:90%; margin-left:5%'>
              <tr><p style='text-decoration: underline; font-size: 20px;'>Zgłoszenia do moich ofert:</p></tr>
                <tr style='background-color: PaleGreen'>
                  <th> opiekun </th>
                  <th> ocena </th>
                  <th> zwierzak </th>
                  <th> usługa </th>
                  <th> data i czas </th>
                  <th> wiadomość </th>
                  <th>  </th>
                </tr>";
              foreach ($result as $row) {
                echo 
                "
                <tr>
                  <td> ".$row["nick"]." </td>
                  <td> ".$row["sr"]." <img src='../../obrazy/ikony/star.png' style='width:20px;'></td>
                  <td> ".$row["nazwa"]." </td>
                  <td> ".$row["nazwa_uslugi"]." </td>
                  <td> ".$row["usluga_start"]." - ".$row["usluga_stop"]." </td>
                  <td> ".$row["wiadomosc"]." </td>
                  <td> 
                      <a href='oferta_check.php?id={$row["oferty_id"]}'>
                        <img src='../../obrazy/ikony/check.png' style='width:30px'>
                      </a>
                      <a href='oferta_out.php?id={$row["oferty_id"]}'>
                        <img src='../../obrazy/ikony/delete.png' style='width:30px'>
                      </a> 
                  </td>
                </tr>";
              }
              echo "</table>";
            } else {
              echo "<em> Brak zgłoszeń do moich ofert &nbsp ಠ_ಠ <br></em>";
            }

            $sql = "SELECT * FROM oferty o, uslugi u, zwierzaki z, opiekun op 
              WHERE u.usluga_id = o.o_usluga_id 
                AND z.zwierzak_id = u.zwierzak_id 
                AND op.opiekun_id = o.o_opiekun_id 
                AND o.o_opiekun_id = ".$_SESSION["id"];
                
            $statement = $connect->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            if ($result && $statement->rowCount() > 0) {
              echo 
              "<br><br>
              <table style='width:80%; margin-left:10%'>
              <tr><p style='text-decoration: underline; font-size: 20px;'>Oferty które chcę przyjąć:</p></tr>
                <tr style='background-color: PaleGreen'>
                  <th> zwierzak </th>
                  <th> usługa </th>
                  <th> data i czas </th>
                  <th> stan oferty </th>
                </tr>";
              foreach ($result as $row) {
                echo "
                <tr>
                  <td> ".$row["nazwa"]." </td>
                  <td> ".$row["nazwa_uslugi"]." </td>
                  <td> ".$row["usluga_start"]." - ".$row["usluga_stop"]." </td>
                  <td> ";
                    if($row["stan_oferty"] == 'zrezygnowano' || $row["stan_oferty"] == 'odrzucone') {
                      ?><p style="color: red"><?php echo $row["stan_oferty"]; ?></p><?php
                    } else if($row["stan_oferty"] == 'zatwierdzone') {
                      ?><p style="color: limeGreen"><?php echo $row["stan_oferty"]; ?></p><?php
                    } else {
                      echo $row["stan_oferty"];
                    }
                  echo "</td>";
                  if($row["stan_oferty"] != "oczekuje na akceptacje" && $row["stan_oferty"] != "zatwierdzone") {
                    echo 
                    "<td> 
                      <a href='oferta_delete.php?id={$row["oferty_id"]}'>
                        <img src='../../obrazy/ikony/delete.png' style='width:30px'>
                      </a>  
                    </td>";
                  }
                echo "</tr>";
              }
              echo "</table>";
            } else {
              echo "<br><em>Brak ofert, które chcę przyjąć &nbsp  (︶^︶) </em>";
            }
          ?> </div>
      </article>
    </section>

    <footer>
      <p> © Natalia Koć</p>
    </footer>

  </body>
</html>