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
	<?php include('../outils/menu.php');?>
		<div id=corps>
			<section>
				<p><h1>Exercice conversation 1</h1></p>
				<h3>Ecoutez la conversation et compléter les phrases avec le mot juste.</h3>
		<?php
			include("../outils/base.php");

			//fonction pour generer les nombres sans repetition
			function randomGen($min, $max, $quantity) {
				$numbers = range($min, $max);
				shuffle($numbers);
				return array_slice($numbers, 0, $quantity);
			}
			$rand_array_rep_trou=randomGen(1,5,5);

			//affiche les reponse possible
			echo "<table style='width:100%'><tr>";
			foreach ($rand_array_rep_trou as $key => $value) {
				$rand_rep_trou=$value;
				//echo $rand_rep_trou;
				$sql = "SELECT * FROM exo WHERE class='trou' AND type='exo_conv' AND support='audio' AND idQuestion='{$rand_rep_trou}'";
				$req = $bd->prepare($sql);
				$req->execute();
				$data_rep_trou=$req->fetchall();
				$req->closeCursor();

				foreach ($data_rep_trou as $un) {
					echo"<td>{$un['reponse']}</td>";
				}
			}
				echo "</tr></table><br>";

			//affiche les question trou
			$sql = "SELECT * FROM exo WHERE support='audio' AND class='trou' AND type='exo_conv' ORDER BY idQuestion ASC";
			$req = $bd->prepare($sql);
			$req->execute();
			$test=$req->fetchall();
			$req->closeCursor();


		echo "<form method='post' action='debug_exo_conv1.php'>";

		foreach ($test as $data){
			$audio=$data['source'];
		}
		echo "<br><audio controls><source src='{$audio}' type='audio/mp4'></audio><br><br>";
				foreach($test as $un )
					{
							echo "{$un['idQuestion']}) {$un['question']}";
							echo "<input type='text' name=\"{$un['id']}\"><br><br>";
					}
			echo "<button id=exoeva type='submit'>Valider !</button>";
		echo "</form>";

		?>
			<br><input id=exoeva type="button" value="Retour" onclick="window.location.href='./exo.php'">
			</section>
		</div>
	</body>
</html>
