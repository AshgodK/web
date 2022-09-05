<?PHP
	include "../../controller/postC.php";
	session_start();
	$pC=new postC();
	
	if (isset($_POST["id"])){
		$pC->updatestate($_POST["id"]);
		header('Location:afficher.php');
	}

?>