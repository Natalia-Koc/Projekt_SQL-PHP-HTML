<?php
	require "../../baza danych/config/config.php";
    require "../../baza danych/lib/lib.php";
	$connect = new PDO($servername, $username, $password, $options);

	$sql = "UPDATE uslugi 
        SET nazwa_uslugi = '{$_POST["nazwa_usluga"]}', 
            cena = ".$_POST["cena"].", 
            usluga_start = '".$_POST["usluga_start"]."', 
            usluga_stop = '".$_POST["usluga_stop"]."' 
                WHERE usluga_id =".$_GET["id"];
    $statement = $connect->prepare($sql);
    $statement->execute();

	header('Location: aktualne.php');
?>