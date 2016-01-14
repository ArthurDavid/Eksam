<?php
	//edit.php
	require_once("edit_functions.php");
	
	//kas kasutaja uuendab andmeid
	if(isset($_POST["update"])){
		
		updateCar($_POST["id"],$_POST["tanklad_nimi"],$_POST["tanklad_aadress"],$_POST["tanklad_kohvik"]);
	}
	
	
	
	//id mida muudame
	if(!isset($_GET["edit"])){
		
		// ei ole aadressieal ?edit=midagi
		// suunan table.php lehele
		
		header("location: table.php");
		
	}else{
		// saada kätte kõige uuemad andmed selle id kohta
		//numbrimärk ja värv
		//küsime andmebaasist andmed id järgi
		
		//saadan kaasa id
		$car_object = getSingleCarData($_GET["edit"]);
		var_dump($car_object);
	}
	
	
	
	
	
?>
<h2>Muuda</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
	<input type="hidden" name="id" value="<?=$_GET["edit"];?>" > 
  	<label for="tanklad_nimi" >Nimi</label><br>
	<input id="tanklad_nimi" name="tanklad_nimi" type="text" value="<?php echo $car_object->tanklad_nimi;?>" ><br><br>
  	<label for="tanklad_aadress" >Aadress</label><br>
	<input id="tanklad_aadress" name="tanklad_aadress" type="text" value="<?=$car_object->tanklad_aadress;?>"><br><br>
	<label for="tanklad_kohvik" >Kohvik?</label><br>
	<input id="tanklad_kohvik" name="tanklad_kohvik" type="text" value="<?=$car_object->tanklad_kohvik;?>"><br><br>
	<input type="submit" name="update" value="Salvesta">
  </form>