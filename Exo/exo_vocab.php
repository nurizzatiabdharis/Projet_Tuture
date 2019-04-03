<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<link rel="icon" type="image/png" href="../img/entete1.png" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu_mobile.js"></script>
	<title>Exercice </title>
</head>
	<body>
		<?php include('../outils/menu.php');?>
			<div id=corps>
				<section>
					<p><h1>Exercice vocabulaire 1</h1></p>
					<h3>Choisissez le mot qui correspondent à l'image</h3>
			<?php
				include("../outils/base.php");
				$sql = "SELECT * FROM exo WHERE support='image' AND class='qcm' AND type='exo_vocab'";
				$req = $bd->prepare($sql);
				$req->execute();
				$test=$req->fetchall();
				$req->closeCursor();

			echo "<form method='post' action='debug_exo_vocab.php'>";
				foreach($test as $un )
				{
					echo "Question {$un['idQuestion']}";
					echo "<br><img src='{$un['source']}' width='130' height='130'><br>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix1']}'>{$un['choix1']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix2']}'>{$un['choix2']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix3']}'>{$un['choix3']}</p>";
				}

				echo "<button id=exoeva type='submit'>Valider </button>";
			echo "</form>";

		?>
			<br><input id=exoeva type="button" value="Retour" onclick="window.location.href='./exo.php'">
			</section>
		</div>
	</body>
</html>
