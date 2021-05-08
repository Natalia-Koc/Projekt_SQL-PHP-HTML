<?php
    session_start();
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);
    $id;

    $sql2 = "SELECT * FROM uslugi WHERE usluga_id = ".$_GET["usluga"];
    $statement = $connect->prepare($sql2);
    $statement->execute();
    $result = $statement->fetchAll();
    if ($result && $statement->rowCount() > 0) {
        foreach ($result as $row) {
            $id = $row["zwierzak_id"];
            $sql = "INSERT INTO oferty (o_wlasciciel_id, o_opiekun_id, o_usluga_id, wiadomosc, stan_oferty) 
        		VALUES (
        			'".$row["wlasciciel_id"]."',
        			'".$_SESSION["id"]."',
        			'".$_GET["usluga"]."',
        			'".$_POST["wiadomosc"]."',
                    'oczekuje na akceptacje'
        		)";
            $statement = $connect->prepare($sql);
        	$statement->execute();
        }
    }

	header('Location: ../zwierzaki/zwierzak_info.php?id='.$id);
?>