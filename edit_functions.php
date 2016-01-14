<?php
	require_once("../configglobal.php");
	$database = "if15_areinlo_2";
	
	function getSingleCarData($edit_id){
		
		//echo "id on ".$edit_id;
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT tanklad_nimi, tanklar_aadress, tanklad_kohvik FROM tanklad WHERE id=? AND deleted IS NULL");
		//asendan ? m�rgi
		$stmt->bind_param("i", $edit_id);
		$stmt->bind_result($tanklad_nimi, $tanklad_aadress, $tanklad_kohvik);
		$stmt->execute();
		
		//tekitan objekti
		$car = new Stdclass();
		
		//saime �he rea andmeid
		if($stmt->fetch()){
			// saan siin alles kasutada bind_result muutujaid
			$car->tanklad_nimi = $tanklad_nimi;
			$car->tanklad_aadress = $tanklad_aadress;
			$car->tanklad_kohvik = $tanklad_kohvik;
			
			
		}else{
			// ei saanud rida andmeid k�tte
			// sellist id'd ei ole olemas
			// see rida v�ib olla kustutatud
			header("Location: table.php");
		}
		
		return $car;
		
		
		$stmt->close();
		$mysqli->close();
		
	}
	function updateCar($id, $tanklad_nimi, $tanklad_aadress, $tanklad_kohvik){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("UPDATE tanklad SET tanklad_nimi=?, tanklad_aadress=?, tanklad_kohvik=? WHERE id=?");
		$stmt->bind_param("ssi",$tanklad_nimi, $tanklad_aadress, $tanklad_kohvik, $id);
		
		// kas �nnestus salvestada
		if($stmt->execute()){
			// �nnestus
			echo "jeeee";
		}
		
		
		$stmt->close();
		$mysqli->close();
		
		
	}
	
	
?>