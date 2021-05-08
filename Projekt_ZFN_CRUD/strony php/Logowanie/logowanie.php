<?php
session_start();
    require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
    $connect = new PDO($servername, $username, $password, $options);

    $nick = $_POST['nick'];
    $password = $_POST['haslo'];

    $sql = "SELECT * FROM opiekun 
    		WHERE nick='" . $nick . "' AND haslo='" . $password . "'";
    $statement = $connect->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll();
      if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) {
            $_SESSION["id"] = $row["opiekun_id"];
            $_SESSION["nick"] = $nick;
        }
        header('Location: ../zwierzaki/stronaGlowna.php');
      } else {
        header('Location: logowanie_rejestracja.php');
      }
?>