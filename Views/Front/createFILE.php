<?php
include "../../controller/postC.php";
require_once '../../model/post.php';
	session_start();
	$postC=new postC();
	
	if (isset($_POST["id"])){
		$t=$_POST["id"];
		$r=$t.".php";
	}
	if (isset($_POST["titre"])){
		$p=$_POST["titre"];
		
	}
	if (isset($_POST["content"])){
		$c=$_POST["content"];
		
	}
	if (isset($_POST["auteur"])){
		$a=$_POST["auteur"];
		
	}
	
	
file_put_contents('comments.php', "");
$file_data = "<?php"."\n"."$"."idc=\"".$t."\";\n";
$file_data .= file_get_contents('testcomment.php');
file_put_contents('comments.php', $file_data);



$myfile = fopen($r, "w") or die("Unable to open file!");
$txt = "<?php  
include 'temp.php'
?>";
$com="<?php 
include 'comments.php'
?>";
$space="&nbsp;&nbsp;&nbsp;&nbsp;";
//$url="1224470.png";
//$image="<img src=";
fwrite($myfile, $txt);
//fwrite($myfile, $image.'"'.$url.'"');
fwrite($myfile,$space.$p."<br/>");
fwrite($myfile,$space.$c."<br/>");
fwrite($myfile,$space."AUTHOR: ".$a."<br/>");
$btl="<br/><br/><br/><br/><br/><br/><br/><br/>";
fwrite($myfile, $btl);
fwrite($myfile, $com);
 $txt = "<?php  
include 'footer.php'
?>"; 
$yry="session_start();&quot";
fwrite($myfile, $txt); 
fwrite($myfile, "$"."test=".$t.$yry); 

                     
fclose($myfile);

$y="location:".$r;
header($y);
?>