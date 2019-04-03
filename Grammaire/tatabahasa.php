<?php
session_start();
 if(isset($_GET['categ']) && !empty($_GET['categ'])){
		if(!isset($_COOKIE['catTata']) || empty($_COOKIE['catTata'])){
			//on crée un cookie pour faire l'affichage de la dernière catégorie affichée
			setcookie('catTata',$_GET['categ'],time()+3600*24*30); //cookie valable 30 jours
		}
		else{
			if($_GET['categ']!=$_COOKIE['catTata']){ //si l'utilisateur sélectionne une autre catégorie que celle enregistrée par le cookie, la valeur du cookie va changer
				setcookie('catTata',$_GET['categ'],time()+3600*24*30);
			}
		}
	}
	else if(isset($_COOKIE['catTata']) && !empty(isset($_COOKIE['catTata']))){
		header('Location: ./tatabahasa.php?categ='.$_COOKIE['catTata']);
		exit;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<link rel="icon" type="image/png" href="../img/entete1.png" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu_mobile.js"></script>
	<title>Grammaire</title>
</head>
	<body>
			<?php include('../outils/menu.php');?>
			<div id=corps>
					<h1>Grammaire (Tatabahasa Asas)</h1>
		<ul>
			<li><a href="./tatabahasa.php?categ=katanama">Les Pronoms et Les Pronoms Possessifs - Kata Nama dan Kata Milik </a></li>
			<li><a href="./tatabahasa.php?categ=katahubung">La Conjonction de Coordination - Kata Hubung</a></li>
			<li><a href="./tatabahasa.php?categ=katasendi">La Preposition - Kata Sendi</a></li>
			<li><a href="./tatabahasa.php?categ=katapemeri">Les Auxiliaires - Kata Pemeri</a></li>
			<li><a href="./tatabahasa.php?categ=adjektif">Les Adjectifs - Kata Adjektif / Kata Sifat</a></li>
			<li><a href="./tatabahasa.php?categ=negation">La Négation - Kata Nafi</a></li>
			<li><a href="./tatabahasa.php?categ=temps">Le temps</a></li>
			<li><a href="./tatabahasa.php?categ=soalan">Poser des questions - Utarakan Soalan</a></li>


		</ul>
		<?php if(isset($_GET['categ']) && !empty($_GET['categ'])){
						include('./'.$_GET['categ'].'.php');
					}
				else{
				echo "<p> Veuillez s&eacute;lectionner une catégorie pour voir le Grammaire</p>";
				}
		?>
				<br><br><br>
		</div>
	</body>
</html>
