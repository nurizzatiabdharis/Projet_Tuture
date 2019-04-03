<?php
/**********
				Partie Evaluation
															**********/
function array_sql_audio($int, $niveau)
{
  global $bd;
  $sql_audios="SELECT * FROM exo WHERE type = '{$niveau}' AND support = 'audio' ORDER BY RAND() LIMIT {$int}";
  $req1 = $bd -> prepare($sql_audios);
  $req1->execute();
  $tableau_exo_audio = $req1->fetchall();
  $req1->closeCursor();
  return $tableau_exo_audio;
}
function array_sql_images($int, $niveau)
{
  global $bd;
  $sql_images="SELECT * FROM exo WHERE type = '{$niveau}' AND support = 'image' ORDER BY RAND() LIMIT {$int}";
  $req1 = $bd -> prepare($sql_images);
  $req1->execute();
  $tableau_exo_images=$req1->fetchall();
  $req1->closeCursor();
  return $tableau_exo_images;
}
function array_QCM($int, $niveau)
{
  global $bd;
  $sql_QCM = "SELECT * FROM exo WHERE type = '{$niveau}' AND class = 'qcm' AND support IS NULL ORDER BY RAND() LIMIT {$int}";
  $req1 = $bd -> prepare($sql_QCM);
  $req1 -> execute();
  $tableau_exo_QCM=$req1->fetchall();
  $req1->closeCursor();
  return $tableau_exo_QCM;
}
function array_trous($int, $niveau)
{
  global $bd;
  $sql_trou = "SELECT * FROM exo WHERE type = '{$niveau}' AND class = 'trou' ORDER BY RAND() LIMIT {$int}";
  $req1 = $bd->prepare($sql_trou);
  $req1->execute();
  $tableau_exo_trou=$req1->fetchall();
  $req1->closeCursor();
  return $tableau_exo_trou;
}
/*******
								Partie correction
																	       *******/
// fonction visant à extraire les données de la variable $_POST et les retourner en sortie sous forme de tableau
function array_extract_from_POST(){
	$donnee_extraite = array();
	foreach ($_POST as $key => $value) {
		$donnee_extraite[$key]=$value;
	}
	return $donnee_extraite;
}
// fonction qui retourne un tableau avec les valeurs VRAI et FAUX pour chaque question et corrige l'évaluation
function tab_correction($donnee_extraite)
{
  global $bd;
  $cpt=1;
  $nb_reponses_justes = 0;
  $nb_nombre_question = 0;
  $tab_result = array();
  // affichage : on retourne vrai si l'utilisateur a juste sinon faux
  // on augmente les variables de comptage
  foreach ($_POST as $id_question => $reponse_user)
  {
    $sql = "SELECT * FROM exo WHERE id='{$id_question}'";
    $req_correction = $bd -> prepare($sql);
    $req_correction -> execute();
    while($fetch = $req_correction -> fetch())
    {
       // affichage : on retourne vrai si l'utilisateur a juste sinon faux
      // on augmente les variables de comptage
      if($fetch['reponse'] == $reponse_user)
      {
        $tab_result[$cpt]='VRAI';
        $nb_reponses_justes++;
        $nb_nombre_question++;
      }
      else
      {
        $tab_result[$cpt]='FAUX';
        $nb_nombre_question++;
      }
    }
  $cpt++;
  }
  return $tab_result;
}
//fonction qui corrige une evaluation : à utiliser après avoir executer array_extract_from_POST() et tab_correction()

function correction_evaluation($donnee_extraite, $tab_result)
{
  global $bd;
  $cpt=1;
  echo "<p> Voici les résultats de votre evaluation ! </p>";
  foreach ($_POST as $id_question => $reponse_user)
  {
    $sql = "SELECT * FROM exo WHERE id='{$id_question}'";
    $req_correction = $bd -> prepare($sql);
    $req_correction -> execute();
    while($fetch = $req_correction -> fetch())
    {
	    /****** On range chaque ligne dans une chaine ($afficher_correction) par l'intermédiaire de la variable string, on gère un affichage différent car certains exercices n'ont pas de questions dans le champs de la table exo *******/
      if($tab_result[$cpt] == 'VRAI')
      {
        $tab_result[$cpt] = '<img src="vrai.png" alt="vrai" width="25" height="25">';
      }
      else
      {
        $tab_result[$cpt]='<img src="faux.png" alt="faux" width="25" height="25">';
      }
	    if(!empty($fetch['question'])) //si la question est NULL
	    {
	    	$string = "<tr>\n\t\t<td>Q{$cpt}</td><td>{$fetch['question']}</td><td>{$fetch['reponse']}</td><td>{$tab_result[$cpt]}</td>\n\t</tr>\n";
	    }
	    else
	    {
	    	$string = "\t<tr>\n\t\t<td>Q{$cpt}</td><td>{$fetch['support']}</td><td>{$fetch['reponse']}</td><td>{$tab_result[$cpt]}</td>\n\t</tr>\n";
	    }
	    if(!isset($afficher_correction) || empty($afficher_correction)){
	        $afficher_correction = $string;
	    }
	       else{
	         $afficher_correction = $afficher_correction.$string;
	       }
	   }
	     $req_correction -> closeCursor();
	     $cpt++;
 	}
   if(isset($nb_nombre_question) && isset($nb_reponses_justes))
   {
     echo "<p> Voici votre note ! Vous avez <strong>{$nb_reponses_justes}/{$nb_nombre_question}</strong>. </p>\n";
	}
   if(isset($afficher_correction))
	{
     echo "\t<table>\n";
     echo "\t{$afficher_correction}"; // on affiche les lignes du tableau
     echo "\t</table>\n";
	}
}

/** fonction qui va décider si l'évaluation va être enregistrer.
Si l'évaluation est enregistrer cela veut dire qu'elle est comptabilisée comme une évaluation pour passer un niveau
**/
function points_XP($id_user, $niveau_user, $nb_reponses_justes, $niveau_evaluation, $nb_reponses_totales)
{
  global $bd;
  $execution_requete = FALSE; //variable booléenne qui va déterminer si nous devons enregistrer
  switch ($niveau_user) {
    case 'nouveau':
      $nb_evaluation = 3;
      if($niveau_evaluation == 'debutant'){
        $execution_requete = TRUE;
      }
      else
      {
        $execution_requete = FALSE;
      }
      break;
    case 'debutant':
      $nb_evaluation = 5;
      if($niveau_evaluation == 'intermediaire'){
        $execution_requete = TRUE;
      }
      else
      {
        $execution_requete = FALSE;
      }
      break;
    case 'intermediaire':
      $nb_evaluation = 7;
      if($niveau_evaluation == 'avance'){
        $execution_requete = TRUE;
      }
      else
      {
        $execution_requete = FALSE;
      }
      break;
    case 'avance':
      $nb_evaluation = 10;
    default:
      $execution_requete = FALSE;
      break;
  }
  if($execution_requete == TRUE) //Dans ce cas, on va enregistrer l'évaluation.
  {
    echo "<p> Cette évaluation est comptabilisée pour votre passage au niveau {$niveau_evaluation} </p>";
    try
    {
      $sql = "INSERT INTO record_evaluation (idUser, niveau, nb_reponses_justes, nb_questions) VALUES ({$id_user}, '{$niveau_evaluation}', {$nb_reponses_justes}, {$nb_reponses_totales})";
      $record = $bd -> prepare($sql);
      $record -> execute();
      $record -> closeCursor();
    }
    catch(Exception $e){
      echo $e;
    }
  }
  else
  {
    echo "<p> Vous avez effectué une évaluation qui ne correspond pas à la passation au niveau suivant. Par conséquent, cette évaluation ne sera pas sauvegardée dans notre base de données. </p>";
  }
}
//fonction qui va indiquer le numéro de la question actuelle
function define_num_question()
{
	$num_question=0;
	if(isset($_POST) && !empty($_POST))
	{
		foreach ($_POST as $cle => $value)
		{
			$check=ctype_digit(substr($cle,0,1)); //la fonction ctype_digit retourne TRUE si c'est un entier
			if($check == TRUE)
			{
				echo "<input id='question{$num_question}' name={$cle} type='hidden' value={$value}>\n";
				$num_question++;
			}
		}
		$num_question++; //il faut ajouter un pour indiquer le numéro de la question actuelle
	}
	else{
		$num_question=1;
	}
	return $num_question;
}
//variable qui va récupérer toutes les informations à une question de l'évaluation et les mettre en forme
// dans un input de type=hidden et ainsi continuer à répondre aux questions
//$nb_questions est une variable qui indique à quel question en est l'utilisateur
function hold_reponses($tableau)
{
	$num_question=1;
	foreach ($tableau as $cle => $value)
	{
		$check=ctype_digit(substr($cle,0,1));//la fonction ctype_digit retourne TRUE si c'est un entier
		if($check == TRUE){
		echo "<input id='question{$num_question}' name={$cle} type='hidden' value={$value}>\n";
				$num_question++;
		}
	}
}

function calcul_niveau($id_user, $niveau_evaluation){

  $border_mark=60; //implies to all level. As long as pass above 60, then ok
  $record_reponse_juste=0; //will contain total number of good answer in cummulative
  $record_total_question=0; //will contain total number of question of one evaluation in cummulative
  $cpt=1; //sert a compter combien d'essai

  //lancer le sql pour avoir des infos sur la totalite max d'essai
  global $bd;
  $sql = "SELECT * FROM record_evaluation WHERE idUser=$id_user AND niveau='$niveau_evaluation'";
  $req = $bd->prepare($sql);
  $req->execute();
  $data_record=$req->fetchall();
  $req->closeCursor();
  foreach ($data_record as $key) {

    $record_reponse_juste=$record_reponse_juste+$key['nb_reponses_justes'];
    $record_total_question=$record_total_question+$key['nb_questions'];
    echo "Essai $cpt : {$key['nb_reponses_justes']}/{$key['nb_questions']}"; //affiche le resultat chaque essai
    echo "<br>";
    $cpt++;
  }

  $final_result=((float)($record_reponse_juste/$record_total_question))*100; //calcul de resultat finale en pourcentage

  echo "Votre resultat finale est {$final_result}% <br>"; //affiche le resultat final en pourcentage

   if ($final_result>=$border_mark){ //si le resultat >60, donc utilisateur gagne le titre debutant

        $sql = "UPDATE user SET niveau='$niveau_evaluation' WHERE id=$id_user"; //affecter nouveau titre a l'utilisateur
        $record = $bd -> prepare($sql);
        $record -> execute();
        $record -> closeCursor();

       $_SESSION['niveau'] = "$niveau_evaluation"; //il faut mis a jour cette variable

      echo "Vous avez bien reussir l'{$niveau_evaluation}, donc vous etes le niveau $niveau_evaluation.";
    }
    else //c-a-d <60, donc rate. On efface tous les enregistrement dans bdD
    {
      $sql = "DELETE FROM record_evaluation WHERE idUser=$id_user AND niveau='$niveau_evaluation'";
      $record = $bd -> prepare($sql);
      $record -> execute();
      $record -> closeCursor();

      echo "Dommage. Vous avez rate cette evaluation. Donc vous devez reprendre cette evaluation pour passer a niveau suivant.";
    }

}
?>
