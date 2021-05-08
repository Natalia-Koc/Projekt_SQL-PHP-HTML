<?php
session_start();
?>
<?php
	$target_dir = "../../obrazy/zdjeciaZwierzakow/"; 
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;																
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		require "../../baza danych/config/config.php";
	    require "../../baza danych/lib/lib.php";
		$connect = new PDO($servername, $username, $password, $options);
		$id = $_GET['id'];

		if(basename($_FILES["fileToUpload"]["name"]) != NULL) {

			$sql = "SELECT * FROM zwierzaki WHERE zwierzak_id=" .$id;
			$statement = $connect->prepare($sql);
			$statement->execute();
			$row = $statement->fetchAll();
		    $file = $row["zdjecie"];

			if (!unlink("../../obrazy/zdjeciaZwierzakow/".$file)) {
			  echo ("Error deleting $file");
			} else {
			  echo ("Deleted $file");
			}
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			    if($check !== false) {
			        echo "File is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        echo "File is not an image.";
			        $uploadOk = 0;
			    }
			}
			// Check if file already exists
			if (file_exists($target_file)) {
			    echo "Sorry, file already exists.";
			    $uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
			    echo "Sorry, your file is too large.";
			    $uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			    echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
			    } else {
			        echo "Sorry, there was an error uploading your file.";
			    }
			}
			
			$sql1 = "UPDATE gatunek 
				SET gatunek = '".$_POST["gatunek"]."', 
					rasa = '".$_POST["rasa"]."' 
						WHERE gatunek_id=".$id;

			$sql2 = "UPDATE zwierzaki 
				SET nazwa = '".$_POST["nazwa"]."', 
					data_urodzenia='".$_POST["data_urodzenia"]. "', 
					opis='".$_POST["opis"]."', 
					zdjecie='".basename( $_FILES["fileToUpload"]["name"])."', 
					plec='".$_POST["plec"]."' 
						WHERE gatunek_id=".$id;
		} else {
			$sql1 = "UPDATE gatunek 
				SET gatunek = '".$_POST["gatunek"]."', 
					rasa = '".$_POST["rasa"]."' 
						WHERE gatunek_id=".$id;

			$sql2 = "UPDATE zwierzaki 
				SET nazwa = '".$_POST["nazwa"]."', 
					data_urodzenia='".$_POST["data_urodzenia"]. "', 
					opis='".$_POST["opis"]."', 
					plec='".$_POST["plec"]."' 
						WHERE gatunek_id=".$id;
		}

		$statement = $connect->prepare($sql1);
	    $statement->execute();
	    $statement = $connect->prepare($sql2);
	    $statement->execute();

		header('Location: moje_konto.php');
?>