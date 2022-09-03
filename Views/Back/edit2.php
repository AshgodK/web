<?PHP
	include "../../controller/postC.php";
	session_start();
	$pC=new postC();
	
	if (isset($_POST["id"])){
		$pC->supprimerpost($_POST["id"]);
		header('Location:edit.php');
	}

?>