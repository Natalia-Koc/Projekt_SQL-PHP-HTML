<?php
    session_start();
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);
    $id;

    $sql2 = "UPDATE oferty SET stan_oferty = 'odrzucone' WHERE oferty_id =".$_GET["id"];
    $statement = $connect->prepare($sql2);
    $statement->execute();

	header('Location: oferty_powiadomienia.php');
?>