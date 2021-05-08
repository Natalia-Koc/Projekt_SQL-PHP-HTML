<?php 
    session_start();
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);

	$sql = "DELETE FROM opiekun_zwierze WHERE zwierzak_id = ".$_GET["id"];
    $statement = $connect->prepare($sql);
	$statement->execute();

	$sql1 = "DELETE FROM zwierzaki WHERE zwierzak_id = ".$_GET["id"];
    $statement = $connect->prepare($sql1);
	$statement->execute();

	$sql2 = "DELETE FROM gatunek WHERE gatunek_id IN (SELECT gatunek_id FROM zwierzaki WHERE zwierzak_id = ".$_GET["id"].")";
    $statement = $connect->prepare($sql2);
	$statement->execute();

	header('Location: moje_konto.php');
?>