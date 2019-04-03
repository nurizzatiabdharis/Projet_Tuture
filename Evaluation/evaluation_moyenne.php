<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<title>Evaluation Intermédiaire </title>
</head>
	<body>
	<?php include('../outils/menu.php');?>
		<div id=corps>
			<section>
				<p><h1> Evaluation Intermédiaire </h1></p>
				<h3>Répondez à ces questions en choisissant la bonne réponse</h3>

        <?php

          function randomGen($min, $max, $quantity) {
          $numbers = range($min, $max);
          shuffle($numbers);
          return array_slice($numbers, 0, $quantity);
          }

          $rand_array=randomGen(1,10,10);
          //print_r(randomGen(0,10,10)); //generates 10 unique random numbers
          //echo"coucou";
          //print_r($rand_array);
          $cpt=1;
          //echo "$cpt";

          echo "<form method='post' action='debug_evaluation_moyenne.php'>";
            foreach ($rand_array as $key => $value) {
            $rand=$value;
            //echo "$rand";

						/*
						Here, the idea is to generate one unique numbers (1,10), then this number will be served as 'idQuestion' where SQL will find it. In otherwords
						we'll have 10 question for debut level. So it should display 10 question randomly at one time (not one by one)
						*/

            include("../outils/base.php");
            $sql1 = "SELECT * FROM exo WHERE type='eva_moy' AND idQuestion='{$rand}'"; //idQuestion will take one unique number
            $req1 = $bd->prepare($sql1);
            $req1->execute();
            $test1=$req1->fetchall();
            $req1->closeCursor();

            //print_r($test1);
            //echo "$test1['support']";
            //$tmp_support=$test1['support'];
            //echo "$tmp_support";
            foreach ($test1 as $un) {
              $tmp_support=$un['support'];
              //echo $tmp_support;
              //echo "---ching---";

							if ($un['class']=='qcm') {
								switch ($tmp_support) {
									case "":
									echo "<p>Question {$cpt}) </p>";
									echo "<p>{$un['question']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix1']}'>{$un['choix1']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix2']}'>{$un['choix2']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix3']}'>{$un['choix3']}</p>
									<br>";
									break;
									case "image":
									echo "Question {$cpt}";
									echo "<br><img src='{$un['source']}' width='130' height='130'><br>
									<p>{$un['question']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix1']}'>{$un['choix1']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix2']}'>{$un['choix2']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix3']}'>{$un['choix3']}</p><br>";
									break;
									case "audio":
									echo "Question {$cpt}";
									echo "<br><audio controls><source src='{$un['source']}' type='audio/mp4'></audio><br>
									<p>{$un['question']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix1']}'>{$un['choix1']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix2']}'>{$un['choix2']}</p>
									<p><input type='radio' name='{$un['id']}' value='{$un['choix3']}'>{$un['choix3']}</p><br>";
									break;
									//default:
									//echo "Erreur !!";
								}
							}

							if ($un['class']=='trou') {
								echo "<p>Question {$cpt}) </p>";
								echo "<p>{$un['question']}</p>";
							  echo "<input type='text' name=\"{$un['id']}\"><br><br>";
							}

            }


            $cpt++; //increment question number
          }

          echo "<button id=exoeva type='submit'>Valider </button>";
          echo "</form>";

          ?>
		<br><input id=exoeva type="button" value="Retour" onclick="window.location.href='./evaluation.php'">

  </div>
  </body>
</html>
