<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
  <link rel="icon" type="image/png" href="../img/entete1.png" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script type="text/javascript" src="../js/menu_mobile.js"></script>
	<title>Latihan Kosa Kata </title>
</head>
	<body>
	<?php include('../outils/menu.php');?>
		<div id=corps>
			<section>
				<p><h1> Latihan Kosa Kata</h1></p>
				<h3>Isi tempat kosong dengan memilih jawapan yang betul.</h3>

        <?php
					include("../outils/base.php");

          function randomGen($min, $max, $quantity) {
          $numbers = range($min, $max);
          shuffle($numbers);
          return array_slice($numbers, 0, $quantity);
          }

          $rand_array=randomGen(1,5,5);
          	$rand_array_rep_trou=randomGen(1,5,5);
          //print_r(randomGen(0,10,10)); //generates 10 unique random numbers
          //echo"coucou";
          //print_r($rand_array);
          $cpt=1;
          //echo "$cpt";

          //affiche les reponse possible
    			echo "<table style='width:100%'><tr>";

    			foreach ($rand_array_rep_trou as $key => $value) {
    				$rand_rep_trou=$value;
    				//echo $rand_rep_trou;

    				$sql = "SELECT * FROM exo WHERE class='trou' AND type='exo_vocab' AND idQuestion='{$rand_rep_trou}'";
    				$req = $bd->prepare($sql);
    				$req->execute();
    				$data_rep_trou=$req->fetchall();
    				$req->closeCursor();

    				foreach ($data_rep_trou as $un) {
    					echo"<td>{$un['reponse']}</td>";
    				}

    			}
    			echo "</tr></table>";

          echo "<form method='post' action='debug_exo_vocab_trou.php'>";
            foreach ($rand_array as $key => $value) {
            $rand=$value;
            //echo "$rand";

						/*
						Here, the idea is to generate one unique numbers (1,10), then this number will be served as 'idQuestion' where SQL will find it. In otherwords
						we'll have 10 question for debut level. So it should display 10 question randomly at one time (not one by one)
						*/


            $sql1 = "SELECT * FROM exo WHERE type='exo_vocab' AND class='trou' AND idQuestion='{$rand}'"; //idQuestion will take one unique number
            $req1 = $bd->prepare($sql1);
            $req1->execute();
            $test1=$req1->fetchall();
            $req1->closeCursor();

            //print_r($test1);
            //echo "$test1['support']";
            //$tmp_support=$test1['support'];
            //echo "$tmp_support";
            foreach ($test1 as $un) {
              echo "<p>Soalan {$cpt}) </p>";
              echo "<br><img src='{$un['source']}' width='130' height='130'>";
              echo "<p>{$un['question']}</p>";
              echo "<input type='text' name=\"{$un['id']}\"><br>";
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
