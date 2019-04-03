<?php
session_start();
 if(isset($_GET['categ']) && !empty($_GET['categ'])){
		if(!isset($_COOKIE['catVocab']) || empty($_COOKIE['catVocab'])){
			//on crée un cookie pour faire l'affichage de la dernière catégorie affichée
			setcookie('catVocab',$_GET['categ'],time()+3600*24*30); //cookie valable 30 jours
		}
		else{
			if($_GET['categ']!=$_COOKIE['catVocab']){ //si l'utilisateur sélectionne une autre catégorie que celle enregistrée par le cookie, la valeur du cookie va changer
				setcookie('catVocab',$_GET['categ'],time()+3600*24*30);
			}
		}
	}
	else if(isset($_COOKIE['catVocab']) && !empty(isset($_COOKIE['catVocab']))){
		header('Location: ./vocab.php?categ='.$_COOKIE['catVocab']);
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
	<title>Vocabulaire</title>
</head>
	<body>
		<?php include('../outils/menu.php');?>
		<div id=corps>
				<h1>Vocabulaire - Kosa kata</h1>
				<ul>
					<li><a href="./vocab.php?categ=couleurs">Les couleurs - Warna </a></li>
					<li><a href="./vocab.php?categ=famille">La famille - Keluarga</a></li>
					<li><a href="./vocab.php?categ=jours">Les jours - Hari</a></li>
					<li><a href="./vocab.php?categ=objets">Les objets - Benda</a></li>
					<li><a href="./vocab.php?categ=nombre">Les nombres - Nombor</a></li>
					<li><a href="./vocab.php?categ=nourriture">La nourriture - Makanan</a></li>
					<li><a href="./vocab.php?categ=animaux">Les animaux - Binatang</a></li>
					<li><a href="./vocab.php?categ=fruits">Les fruits et légumes - Buah-buahan dan Sayur-sayuran</a></li>
					<li><a href="./vocab.php?categ=conversation">Les conversations - Perbualan</a></li>
				</ul>
				<?php if(isset($_GET['categ']) && !empty($_GET['categ'])){
					include('./'.$_GET['categ'].'.php');
				}else{
				echo "<p> Veuillez s&eacute;lectionner une catégorie pour voir le vocabulaire.</p>";
				}
				?>
				<br><br>
		</div>
	</body>
</html>





