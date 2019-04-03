<?php
$acces = 0;
if(isset($acces) && $acces==0){
	header('Location: ../index.php?error=forbidden');
	exit;
}
else{
	$nomgrp_etus = array('RT2','RTlp','RTp');
	$identifiant = "tt604966";
	$mdp = "";
	include_once('../CAS/CAS-1.3.5/CAS-1.3.5/CAS.php');
	ob_start();
	phpCAS::client(CAS_VERSION_2_0,'login.unice.fr',443,'/login');
	phpCAS::setNoCasServerValidation();
	phpCAS::forceAuthentication();
	$login = phpCAS::getUser();
	if(phpCAS::getUser()){ //Si réelement connecté
	       echo "L'utilisateur : ".phpCAS::getUser()." est connecté";
	       // Utilisateur connecté on peut faire ce que l'on veux
	}
}
?>