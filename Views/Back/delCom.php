<?PHP
	include "../../controller/commentC.php";
	session_start();
	$comC=new commentC();
	
	if (isset($_POST["id"])){
		$comC->supprimercom($_POST["id"]);
		header('Location:afficher.php');
	}

?>