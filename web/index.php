<?php 
include ('ihm.php'); 

if ($_GET["action"] == "aaa"){
	doAction("aaa");
}

if ($_POST["action"] == "bbb"){
	doAction("bbb");
}
// etc


?>
