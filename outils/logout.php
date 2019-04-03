<?php
session_start(); //Démarrage de la session
session_destroy(); //Destruction de la session
header("Location: ../index.php");//Redirection vers login.php
exit;
?>