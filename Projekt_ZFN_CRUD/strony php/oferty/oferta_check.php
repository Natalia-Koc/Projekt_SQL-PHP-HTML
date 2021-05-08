<?php
    session_start();
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);

    $sql2 = "UPDATE oferty SET stan_oferty = 'zatwierdzone' WHERE oferty_id =".$_GET["id"];
    $statement = $connect->prepare($sql2);
    $statement->execute();

    $sql2 = "SELECT * FROM oferty WHERE oferty_id = ".$_GET["id"];
    $statement = $connect->prepare($sql2);
    $statement->execute();
    $result = $statement->fetchAll();
    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) {
            $sql3 = "UPDATE uslugi SET opiekun_id = ".$row["o_opiekun_id"]." WHERE usluga_id = ".$row["o_usluga_id"];
		    $statement = $connect->prepare($sql3);
		    $statement->execute();
        }
    }


	header('Location: oferty_powiadomienia.php');
?>