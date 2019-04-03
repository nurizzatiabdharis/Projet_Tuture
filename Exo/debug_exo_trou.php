<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<link rel="icon" type="image/png" href="../img/entete1.png" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu_mobile.js"></script>
	<title>Exercice</title>
</head>
	<body>

	<body>
	<?php include('../outils/menu.php');?>
		<div id=corps>
			<section>
				<p><h1> Exercice grammaire 2 </h1></p>

			<?php
				include("../outils/base.php");
					$sql = "SELECT * FROM exo WHERE type='exo_gram' AND class='trou'";
					$req = $bd->prepare($sql);
					$req->execute();
					$test=$req->fetchall();
					$req->closeCursor();

				//print_r($_POST);
				$size=count($test);

			$i=0;
			foreach ($_POST as $key => $value) {
			  foreach ($test as $champ) {
				if ($key == $champ['id']){
				  if ($value == $champ['reponse']){
					echo "Reponse <strong>vrai</strong> pour la question {$champ['idQuestion']} <br><br>";
					$i++;
				  }
					else
					{
					  echo "Reponse <strong>faux</strong> pour la question {$champ['idQuestion']} <br><br>";
					}
				  }
				}
			  }
			echo "Votre note : <strong>{$i}/{$size}</strong><br>";
			?>
			<br><input id=exoeva type="button" value="Refaire la question" onclick="window.location.href='./exo_trou.php'">
<br><br><input id=exoeva type="button" value="D'autre question" onclick="window.location.href='./exo.php'">
			</section>
		</div>
	</body>


	</body>
</html>
