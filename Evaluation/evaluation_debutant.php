<?php
  session_start();
  include("../outils/connexion.php");
  include("../outils/base.php");
  include("./fonctions.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<title>Evaluation Débutant</title>
</head>
	<body>
	<?php include('../outils/menu.php');?>
  <div id=deco>
      <a href='#'><img id=deconnex src='../img/deco.jpg' alt='D&eacute;connexion' title='D&eacute;connexion' /></a>
  </div>
		<div id=corps>
			<section>
				<p><h1> Evaluation Débutant </h1></p>
				<h3>Répondez à ces questions en choisissant la bonne réponse</h3>
        <?php
          $cpt=1;
          echo "<form method='post' action='debug_evaluation_debutant.php'>";
            /*****
                    Récuperer les types de questions que l'on veut dans notre evaluation 
                                                                                          ********/
            /******** les 2 questions QCM avec support audio ***********/
            $tableau_exo_audio=array_sql_audio(2,'eva_deb');
            /******** les 2 questions QCM avec support image ***********/
            $tableau_exo_images = array_sql_images(2, 'eva_deb');
            /******* les  3 questions QCM avec un support NULL ******/
            $tableau_exo_QCM = array_QCM(3, 'eva_deb');
            /******* les  3 questions de type trou ******/
            $tableau_exo_trou = array_trous(3,'eva_deb');
            /**** Une fois les questions récupérées dans des tableau, on va les regrouper dans un tableau unique ****/
            $tab_questions = array(); //tableau qui va accueillir toutes les infos des questions qui seront posées
            foreach ($tableau_exo_audio as $key => $value) {
               $tab_questions[$cpt]=$value;
               $cpt++;
             }
            foreach ($tableau_exo_images as $key => $value) {
              $tab_questions[$cpt]=$value;
              $cpt++;
            }
            foreach ($tableau_exo_QCM as $key => $value) {
              $tab_questions[$cpt]=$value;
              $cpt++;
            }
            foreach ($tableau_exo_trou as $key => $value) {
              $tab_questions[$cpt]=$value;
              $cpt++;
            }
            /***** Il ne reste plus que l'affichage des questions *****/
            //$tab_question est un tableau à 2 dimensions (= tableau dans un tableau)
            foreach ($tab_questions as $key => $array_questions) 
            {
              $cpt = $key;
              if($array_questions['class']=='qcm'){
                  switch ($array_questions['support']){
                    case "": //si le support est vide
                      echo "<p>Question {$cpt}) </p>";
                      echo "<p>{$array_questions['question']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix1']}'>{$array_questions['choix1']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix2']}'>{$array_questions['choix2']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix3']}'>{$array_questions['choix3']}</p>
                      <br>";
                      break;
                      // cas d'une question QCM avec une image
                    case "image":
                      echo "<p>Question {$cpt}) </p>";
                      echo "<br><img src='{$array_questions['source']}' width='130' height='130'><br>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix1']}'>{$array_questions['choix1']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix2']}'>{$array_questions['choix2']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix3']}'>{$array_questions['choix3']}</p><br>";
                      break;
                      // cas d'une question QCM avec une video
                    case "audio":
                      echo "<p>Question {$cpt}) </p>";
                      echo "<br><audio controls><source src='{$array_questions['source']}' type='audio/mp4'></audio><br>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix1']}'>{$array_questions['choix1']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix2']}'>{$array_questions['choix2']}</p>
                      <p><input type='radio' name='{$array_questions['id']}' value='{$array_questions['choix3']}'>{$array_questions['choix3']}</p><br>";
                      break;
                    default:
                      echo "Erreur de support !!";
                      break;
                  }
              }
            }
            /*****
              Partie affichage des textes à trous
            ******/
            $data_rep_trous = array();
            foreach ($tab_questions as $key => $array_questions) {
              $sql="SELECT reponse FROM exo WHERE id='{$array_questions['id']}'";
              $req_choix_trous = $bd -> prepare($sql);
              $req_choix_trous -> execute();
              while($fetch = $req_choix_trous -> fetch()){
                if ($array_questions['class'] == 'trou'){
                  $data_rep_trous[]=$fetch['reponse'];
                }
              }
            }
            shuffle($data_rep_trous); // on mélange l'ordre des réponses pour les questions texte à trous
            //affiche les reponses possible
              echo "<table style='width:100%'><tr>";
            foreach ($data_rep_trous as $key => $choix_rep) {
              echo "<td> {$choix_rep} </td>";
            }
            echo "</tr></table>";
            foreach ($tab_questions as $key => $array_questions)
            {
              if ($array_questions['class'] == 'trou'){
                $cpt = $key;
                echo "<p>Question {$cpt}) </p>";
                echo "<p>{$array_questions['question']}</p>";
                echo "<input type='text' name=\"{$array_questions['id']}\"><br><br>";
                }
            }
            echo "<button id='exoeva' type='submit'>Valider </button>";
            echo "</form>";
            $bd = null;
          ?>
          <br><input id="exoeva" type="button" value="Retour" onclick="window.location.href='./evaluation.php'">
  </div>
  </body>
</html>
