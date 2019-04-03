<?php
if(!isset($_SESSION['id']))
{
	$host=explode('/', $_SERVER['PHP_SELF']);
 	header('Location: /'.$host[1].'/?error=redirect');
 	exit;
}
?>