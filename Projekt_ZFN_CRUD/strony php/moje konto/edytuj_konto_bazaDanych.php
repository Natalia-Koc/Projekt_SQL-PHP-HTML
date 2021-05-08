<?php
    session_start();

	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);

	$sql = "UPDATE opiekun 
        SET nick = '{$_POST["nick"]}', 
            haslo = '{$_POST["haslo"]}',
            imie = '{$_POST["imie"]}', 
            nazwisko = '{$_POST["nazwisko"]}', 
            telefon = '{$_POST["telefon"]}',
            miasto = '{$_POST["miasto"]}',
            ulica = '{$_POST["ulica"]}',
            dom = '{$_POST["dom"]}',
            mieszkanie = '{$_POST["mieszkanie"]}'
                WHERE opiekun_id =".$_SESSION["id"];
    $statement = $connect->prepare($sql);
    $statement->execute();

	header('Location: moje_konto.php');
?>