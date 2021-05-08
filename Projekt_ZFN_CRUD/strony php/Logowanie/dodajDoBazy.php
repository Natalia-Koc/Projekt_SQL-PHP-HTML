<?php
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);

	$sql = "INSERT INTO opiekun (nick, imie, nazwisko, haslo, telefon, miasto, ulica, dom, mieszkanie) 
    			VALUES (
    				'".$_POST["nick"]."',
    				'".$_POST["imie"]."',
    				'".$_POST["nazwisko"]."',
    				'".$_POST["haslo"]."',
    				'".$_POST["telefon"]."',
    				'".$_POST["miasto"]."',
    				'".$_POST["ulica"]."',
    				'".$_POST["dom"]."',
    				'".$_POST["mieszkanie"]."'
    			)";
    $statement = $connect->prepare($sql);
	$statement->execute();

	header('Location: logowanie_rejestracja.php');
?>