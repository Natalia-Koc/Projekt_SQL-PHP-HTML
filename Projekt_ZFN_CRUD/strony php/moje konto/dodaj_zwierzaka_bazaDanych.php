<?php
session_start();
?>
<?php
    $target_dir = "../../obrazy/zdjeciaZwierzakow/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if file already exists
    if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	if ($_FILES["fileToUpload"]["size"] > 1600000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}

	if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
            require "../../baza danych/config/config.php";
		    require "../../baza danych/lib/lib.php";
			$connect = new PDO($servername, $username, $password, $options);


			$sql1 = "INSERT INTO gatunek (gatunek, rasa) 
            	VALUES ('".$_POST["gatunek"]."','".$_POST["rasa"]."')";
            $statement = $connect->prepare($sql1);
		    $statement->execute();

		    $sql3 = "SELECT MAX(gatunek_id) as id FROM gatunek";
		    $statement = $connect->prepare($sql3);
			$statement->execute();
			$result = $statement->fetchAll();
			if ($result && $statement->rowCount() > 0) {
				foreach ($result as $row) {
				  $id = $row["id"];
				}
			}

            $sql2 = "INSERT INTO zwierzaki (zdjecie, nazwa, gatunek_id, data_urodzenia, opis, plec) VALUES ('brak_zdjecia.jpg','".$_POST["nazwa"]."','$id','".$_POST["data_urodzenia"]."','".$_POST["opis"]."','".$_POST["plec"]."')";
		    $statement = $connect->prepare($sql2);
		    $statement->execute();

		    $sql3 = "SELECT MAX(zwierzak_id) as z_id FROM zwierzaki";
		    $statement = $connect->prepare($sql3);
			$statement->execute();
			$result = $statement->fetchAll();
			if ($result && $statement->rowCount() > 0) {
				foreach ($result as $row) {
				  $z_id = $row["z_id"];
				}
			}

		    $moje_id = $_SESSION["id"];
		    $sql4 = "INSERT INTO opiekun_zwierze (opiekun_id, zwierzak_id) VALUES ('$moje_id', '$z_id')";
		    $statement = $connect->prepare($sql4);
		    $statement->execute();

            header('Location: moje_konto.php');
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded."; 
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
            
    		require "../../baza danych/config/config.php";
		    require "../../baza danych/lib/lib.php";
			$connect = new PDO($servername, $username, $password, $options);

			$sql1 = "INSERT INTO gatunek (gatunek, rasa) 
            	VALUES ('".$_POST["gatunek"]."','".$_POST["rasa"]."')";
            $statement = $connect->prepare($sql1);
		    $statement->execute();

		    $sql3 = "SELECT MAX(gatunek_id) as id FROM gatunek";
		    $statement = $connect->prepare($sql3);
			$statement->execute();
			$result = $statement->fetchAll();
			if ($result && $statement->rowCount() > 0) {
				foreach ($result as $row) {
				  $id = $row["id"];
				}
			}

            $sql2 = "INSERT INTO zwierzaki (zdjecie, nazwa, gatunek_id, data_urodzenia, opis, plec) VALUES ('".basename( $_FILES["fileToUpload"]["name"])."','".$_POST["nazwa"]."','$id','".$_POST["data_urodzenia"]."','".$_POST["opis"]."','".$_POST["plec"]."')";
		    $statement = $connect->prepare($sql2);
		    $statement->execute();

		    $sql3 = "SELECT MAX(zwierzak_id) as z_id FROM zwierzaki";
		    $statement = $connect->prepare($sql3);
			$statement->execute();
			$result = $statement->fetchAll();
			if ($result && $statement->rowCount() > 0) {
				foreach ($result as $row) {
				  $z_id = $row["z_id"];
				}
			}

		    $moje_id = $_SESSION["id"];
		    $sql4 = "INSERT INTO opiekun_zwierze (opiekun_id, zwierzak_id) VALUES ('$moje_id', '$z_id')";
		    $statement = $connect->prepare($sql4);
		    $statement->execute();

            header('Location: moje_konto.php');
    }
?>