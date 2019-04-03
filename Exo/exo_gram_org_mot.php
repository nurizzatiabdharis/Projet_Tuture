<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
  <link rel="icon" type="image/png" href="../img/entete1.png" />
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  <script type="text/javascript" src="../js/menu_mobile.js"></script>
	<title>Latihan Susun Perkataan</title>
</head>
	<body>
	<?php include('../outils/menu.php');?>
		<div id=corps>
			<section>
				<p><h1> Latihan Susun Perkataan</h1></p>
				<h3>Susun semula perkataan yang diberi untuk dijadikan satu ayat yang lengkap. Sila beri perhatian kepada huruf besar dan tanda noktah.</h3>
        <sub>Organiser ces mots pour qu'ils forment une phrase. Faites attention avec l'utilisation des majuscule et les points.</sub>
        <?php
					include("../outils/base.php");

          $sql = "SELECT * FROM exo WHERE type='exo_gram_org_mot' AND class='trou'"; //idQuestion will take one unique number
          $req = $bd->prepare($sql);
          $req->execute();
          $test=$req->fetchall();
          $req->closeCursor();


          function randomGen($min, $max, $quantity) {
          $numbers = range($min, $max);
          shuffle($numbers);
          return array_slice($numbers, 0, $quantity);
          }

          $max=count($test);
          $rand_array=randomGen(1,$max,$max);
          $cpt=1;

          echo "<form method='post' action='debug_exo_gram_org_mot.php'>";
            foreach ($rand_array as $key => $value) {
            $rand=$value;

            foreach ($test as $un) {
              if ($un['idQuestion']==$rand){
                echo "<p>Soalan {$cpt}) </p>";
                echo "<p>{$un['question']}</p>";
                echo "<input type='text' name=\"{$un['id']}\"><br>";
              }
            }
            $cpt++; //increment question number
          }

          echo "<button id=exoeva type='submit'>Valider </button>";
          echo "</form>";

          ?>
		<br><input id=exoeva type="button" value="Retour" onclick="window.location.href='./exo.php'">

  </div>
  </body>
</html>
