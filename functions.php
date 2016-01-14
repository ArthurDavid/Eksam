<?php

	// functions.php
	require_once("../configglobal.php");
	$database = "if15_areinlo_2";
	
	//loome uut funktsiooni, et küsida ab'ist andmeid
	function getCarData(){
		
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		
		$stmt = $mysqli->prepare("SELECT id, tanklad_nimi, tanklad_aadress, tanklad_kohvik FROM tanklad WHERE deleted is NULL");
		echo $mysqli->error;
		$stmt->bind_result($id, $tanklad_nimi, $tanklad_aadress, $tanklad_kohvik_from_db);
		$stmt->execute();
		
		// tühi massiiv kus hoiame objekte (1 rida andmeid)
		$array = array();
		
		// tee tsüklit nii mitu korda, kui saad
		//ab'ist ühe rea andmeid
		while($stmt->fetch()){
			
			// loon objekti iga while tsükli kord
			$car = new StdClass();
			$car->id = $id;
			$car->tanklad_nimi = $tanklad_nimi;
			$car->tanklad_aadress = $tanklad_aadress;
			$car->tanklad_kohvik = $tanklad_kohvik_from_db;
			
			// lisame selle massiivi
			array_push($array, $car);
			//echo "<pre>";
			//var_dump($array);
			//echo "</pre>";
		}
		
		
		
		$stmt->close();
		$mysqli->close();
		
		return $array;
		
	}
	
	//echo $mysqli->error;
	function deleteCar($id_to_be_deleted){
		$mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		$stmt = $mysqli->prepare("UPDATE tanklad SET deleted=NOW() WHERE id=?");
		$stmt->bind_param("i", $id_to_be_deleted);
		
		if($stmt->execute()){
			// sai edukalt kustutatud
			header("Location: table.php");
			
			
		}
		
		$stmt->close();
		$mysqli->close();
		
		
	}
	getCarData();
	
	
	
?>