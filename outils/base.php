<?php
$serv='localhost';
$base='mgautero_mal1';
$log='mgautero_mal1';
$mdp='mal12017';
try {
$bd = new PDO ( "mysql:host={$serv};dbname={$base}",
 "{$log}", "{$mdp}" ); 
}
catch (Exception $e){
	die ("connexion a la base impossible");
}
?>