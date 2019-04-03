<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<title>Evaluation Avancée</title>
</head>
	<body>
	<?php include('../outils/menu.php');?>
		<div id=corps>
			<section>
			<p><h1> Evaluation Avancée</h1></p>
		<?php
		
		echo "<form method='post' action='debug_evaluation_avancee.php'>";

			//fonction pour generer les nombres sans repetition
			function randomGen($min, $max, $quantity) {
				$numbers = range($min, $max);
				shuffle($numbers);
				return array_slice($numbers, 0, $quantity);
			}

			$rand_array_ecouter=randomGen(1,5,5);
			$rand_array_qcm=randomGen(6,10,5);
			$rand_array_trou=randomGen(11,15,5);
			$rand_array_rep_trou=randomGen(11,15,5);

			//requete pour exo ecouter
			echo "<p><h1>Exercice conversation</h1></p>
			<h3>Ecoutez la conversation et répondez à ces questions en choisissant la bonne réponse</h3>";

			include("../outils/base.php");
			$sql = "SELECT * FROM exo WHERE support='audio' AND class='qcm' AND type='eva_ava'";
			$req = $bd->prepare($sql);
			$req->execute();
			$test=$req->fetchall();
			$req->closeCursor();

			/* affiche audio*/
			foreach ($test as $data){
				$audio=$data['source'];
			}
			echo "<br><audio controls><source src='{$audio}' type='audio/mp4'></audio><br>";

			$cpt_audio=1;
			$cpt_qcm=6;
			$cpt_trou=11;

			foreach ($rand_array_ecouter as $key => $value) {
				$rand=$value;

				$sql = "SELECT * FROM exo WHERE support='audio' AND class='qcm' AND type='eva_ava' AND idQuestion='{$rand}'";
				$req = $bd->prepare($sql);
				$req->execute();
				$data_audio=$req->fetchall();
				$req->closeCursor();

				foreach ($data_audio as $un) {
					echo "<p>Soalan {$cpt_audio}) </p>";
					echo "<p>{$un['question']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix1']}'>{$un['choix1']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix2']}'>{$un['choix2']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix3']}'>{$un['choix3']}</p>
					<br>";
				}
				$cpt_audio++;
			}

			//requete pour QCM
			echo "<p><h1>Exercice QCM</h1></p>
			<h3>Répondez à ces questions en choisissant la bonne réponse</h3>";

			foreach ($rand_array_qcm as $key => $value) {
				$rand_qcm=$value;
				//echo $rand_qcm;

				$sql = "SELECT * FROM exo WHERE class='qcm' AND type='eva_ava' AND idQuestion='{$rand_qcm}'";
				$req = $bd->prepare($sql);
				$req->execute();
				$data_qcm=$req->fetchall();
				$req->closeCursor();

				foreach ($data_qcm as $un) {
					echo "<p>Soalan {$cpt_qcm}) </p>";
					echo "<p>{$un['question']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix1']}'>{$un['choix1']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix2']}'>{$un['choix2']}</p>
					<p><input type='radio' name='{$un['id']}' value='{$un['choix3']}'>{$un['choix3']}</p>
					<br>";
				}
				$cpt_qcm++;

			}

			//requete pour trou
			echo "<p><h1>Exercice Trou</h1></p>
			<h3>Répondez à ces questions en choisissant la bonne réponse</h3>";

			//affiche les reponse possible
			echo "<table style='width:100%'><tr>";

			foreach ($rand_array_rep_trou as $key => $value) {
				$rand_rep_trou=$value;
				//echo $rand_rep_trou;

				$sql = "SELECT * FROM exo WHERE class='trou' AND type='eva_ava' AND idQuestion='{$rand_rep_trou}'";
				$req = $bd->prepare($sql);
				$req->execute();
				$data_rep_trou=$req->fetchall();
				$req->closeCursor();

				foreach ($data_rep_trou as $un) {
					echo"<td>{$un['reponse']}</td>";
				}

			}
			echo "</tr></table>";

			//affiche les question trou
			foreach ($rand_array_trou as $key => $value) {
				$rand_trou=$value;

				$sql = "SELECT * FROM exo WHERE class='trou' AND type='eva_ava' AND idQuestion='{$rand_trou}'";
				$req = $bd->prepare($sql);
				$req->execute();
				$data_trou=$req->fetchall();
				$req->closeCursor();

				foreach ($data_trou as $un) {
					echo "<p>Soalan {$cpt_trou}) </p>";
					echo "<p>{$un['question']}</p>";
					echo "<input type='text' name=\"{$un['id']}\"><br>";
				}
				$cpt_trou++;
			}

			echo "<br><button id=exoeva type='submit'>Valider !</button>";
		echo "</form>";

		?>
			<br><input id=exoeva type="button" value="Retour" onclick="window.location.href='./evaluation.php'">
			</section>
		</div>
	</body>
</html>
