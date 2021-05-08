<?php 
    session_start();
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);

	$sql = "INSERT INTO uslugi (wlasciciel_id, zwierzak_id, nazwa_uslugi, cena, usluga_start, usluga_stop) 
		VALUES (
			'".$_SESSION["id"]."',
			'".$_POST["zwierzak_id"]."',
			'".$_POST["nazwa_uslugi"]."',
			'".$_POST["cena"]."',
			'".$_POST["usluga_start"]."',
			'".$_POST["usluga_stop"]."'
		)";
    $statement = $connect->prepare($sql);
	$statement->execute();

	header('Location: ../oferty/aktualne.php');
?>