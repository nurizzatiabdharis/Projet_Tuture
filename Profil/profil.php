<?php session_start();
include('../outils/connexion.php');
include('../outils/base.php');
include('../outils/format.php');
$id_user = $_SESSION['id'];
// requete retournant un tableau utilisé pour afficher l'historique des évaluations
$sql = "SELECT * FROM record_evaluation WHERE idUser=$id_user";
$requete = $bd -> prepare($sql);
$requete -> execute();
$eval_record = $requete->fetchall();
$nb_record = $requete -> rowCount();
$requete -> closeCursor();
/* METHODE :
 	- On va faire un tableau 2D qui contiendra les informations pour chaque niveau
 	- Conséquence : on utilisera un unique tableau pour l'affichage ou le traitement des informations
On va faire une initialisation des données qu'on connait déjà*/
// ETAPE 1 : connaitre les requetes sur les niveaux à effectuer : $niveaux retourne VRAI si l'utilisateur peut accèder aux évaluations d'un niveau donné
$niveaux = array(); //tableau des niveaux utilisés pour la requete
$tab_niveau = array(); // tableau rempli a la fin de la requete
switch ($_SESSION['niveau']) {
	case 'nouveau':
	// l'utilisateur de niveau nouveau pourrait avoir déjà effectué des évaluations de niveau débutant
		$niveau['debutant']=TRUE;
		$niveau['intermediaire']= FALSE;
		$niveau['avance']= FALSE;
		break;
	case 'debutant':
	// l'utilisateur de niveau débutant a déjà effectué ses évaluations de niveau débutant et pourrait avoir déjà effectué des évaluations de niveau intermédiaire
		$niveau['debutant']= TRUE;
		$niveau['intermediaire']= TRUE;
		$niveau['avance'] = FALSE;
		break;
	case 'intermediaire':
	// l'utilisateur de niveau intermédiaire a déjà effectué ses évaluations de niveaux débutant & intermédiaires et pourrait avoir déjà effectué des évaluations de niveau avancé
		$niveau['debutant'] = TRUE;
		$niveau['intermediaire'] = TRUE;
		$niveau['avance'] = FALSE;
		break;
	case 'avance':
	// l'utilisateur de niveau débutant a déjà effectué ses évaluations de niveau débutant, intermédiaire & avancé.
		$niveau['debutant'] = TRUE;
		$niveau['intermediaire'] = TRUE;
		$niveau['avance'] = TRUE;
		break;
	default:
	// on ne reconnait pas le niveau :-/
		$niveau['debutant'] = FALSE;
		$niveau['intermediaire'] = FALSE;
		$niveau['avance']= FALSE;
		echo "<p> ERREUR : Le niveau {$_SESSION['niveau']} inconnu... Merci de vérifier que le nom corresponde bien avec les cas.</p>";
		break;
}
foreach ($niveau as $index_niveau => $value)
{
	switch ($index_niveau)
	{
		//ajouter les baremes : on va compter le nombre d'evaluations faites puis ensuite soustraire ce bareme pour déterminer le nombre d'évaluations restantes avant la validation du prochain niveau
		case 'debutant':
			$nb_evaluation = 3;
			break;
		case 'intermediaire':
			$nb_evaluation = 5;
			break;
		case 'avance':
			$nb_evaluation = 7;
			break;
		default:
			$nb_evaluation = NULL;
			echo "<p>ERREUR :  Le niveau inscrit dans la variable $tab_niveau ne correspond pas au condition... Mercu de vérifier si la syntaxe est exacte.</p>";
			break;
	}
	if($nb_evaluation != NULL) //si le bareme est connu : le niveau est connu
	{
		if($value == TRUE) //si cette valeur est VRAI, on va récupérer les informations des évaluations dans la base de données
		{
			$cpt = 0;
			$border_mark=60; //implies to all level. As long as pass above 60, then ok
			$record_reponse_juste=0; //will contain total number of good answer in cummulative
			$record_total_question=0; //will contain total number of question of one evaluation in cummulative
			//lancer le sql pour avoir des infos sur la totalite max d'essai
			$sql = "SELECT * FROM record_evaluation WHERE idUser={$id_user} AND niveau='{$index_niveau}'";
			$req = $bd->prepare($sql);
			$req->execute();
			$nb_eval_done = $req->rowCount(); //compte le nombre d'évaluations effectuées si elle est à zéro c'est pas la peine qu'on fasse le calcul parce qu'on sait qu'il en a pas fait
			if($nb_eval_done != 0) 
			/***	Si des lignes sont comptées, elles correspondent à des évaluations effectuées pour ce niveau
					si au contraire, cette variable est à 0 cela signifie que l'utilisateur peut faire des évaluations pour ce niveau mais qu'il n'en a pas encore faite.	
			***/
			{
				$data_record=$req->fetchall(); // on récupère les informations des lignes concernées et on les range dans un tableau
				// requete qui va déterminer son niveau en pourcentage
				foreach ($data_record as $key)
				{
					$record_reponse_juste=$record_reponse_juste+$key['nb_reponses_justes'];
					$record_total_question=$record_total_question+$key['nb_questions'];
				}
				$final_result = round(((float)($record_reponse_juste/$record_total_question))*100,1); //calcul de resultat finale en pourcentage, on arrondit à un chiffre après la virgule
				$nb_eval_rest = $nb_evaluation - $nb_eval_done;
				
/********************************************
 PARTIE :
	Interpréter les résultats obtenus
*********************************************/

				if($nb_eval_rest == 0)
				{
					//cela signifie que le niveau est forcément acquis car si n'a pas la moyenne, ces évaluations pour ce niveau seront effacés (voir debug_evaluation_*.php)
					$information = "<p>Niveau déjà validé</p>";
				}
				else
				{
					//l'utilisateur a commencé à faire des évaluations pour un certain niveau mais n'en a pas encore fait suffisamment pour passer au niveau suivant
					$information = "<p>Nombre d'evaluations restantes : {$nb_eval_rest}<br>Vous êtes actuellement à {$final_result} % de bonnes réponses</p>";
				}
			}
			else //Aucune évaluation n'a été faite pour ce niveau (mais il a la possibilité d'en faire)
			{
				$nb_eval_rest = $nb_evaluation;
				$final_result = 0;
				$information = "<p> Nombre d'evaluations restantes : {$nb_eval_rest}<br>Vous n'avez pas encore effectué d'évaluations pour ce niveau !</p>";
			}
			$req->closeCursor();
		}
		else // == if($value == FALSE){...} Pour les évaluations de niveaux qu'il n'a pas encore la possibilité d'effectuer
		{
			$nb_eval_rest = 'NON';
			$final_result = 'NON';
			$information = "<p>Vous ne pouvez pas encore effectuer ce niveau</p>";
		}
	//Remplissage du tableau à 2 dimensions
	$tab_niveau[$index_niveau]['nb_eval_rest'] = $nb_eval_rest; //contient le nombre d'évaluations restantes
	$tab_niveau[$index_niveau]['final_result'] = $final_result; //contient le taux en % de réponses justes
	$tab_niveau[$index_niveau]['information'] = $information;	//contient un message informatif
	} // end (if($nb_evaluation != NULL))
	$cpt++;
} //end foreach
// on veut ensuite savoir les choses suivantes : Le pourcentage des bonnes réponses actuelles, le nombre de d'évaluations qui lui restent pour atteindre le prochain niveau
?>
<!DOCTYPE HTML>
<html>
 <lang=fr>
 <head>
  <meta charset='utf-8'/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/site.css"/>
  <link rel="icon" type="image/png" href="../img/entete1.png" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu_mobile.js"></script>
  <title>Profil</title>
  <style type="text/css">
			.progress{
				text-align:right;
				background:green;
			}
  </style>
 </head>
	 <body>
		<?php include('../outils/menu.php');?>
		<div id=corps>
			<caption> Votre progression actuelle </caption>
			<table class="maxWidth" style="border : none;">
				<tr>
			<?php foreach ($tab_niveau as $key => $value):?>
					<?php $nom_niveau = aff_lvl($key); ?>
					<th style="width: 33%; margin-right:0; margin-left : 0; padding-right: 0; padding-left: 0"><?php echo "<p>{$nom_niveau}</p>{$value['information']}";?> </th>
			<?php endforeach; ?>
				</tr>
			<?php
			$taille_tab=count($tab_niveau);
			$cpt=1;
			?>
			<?php foreach ($tab_niveau as $key => $value):?>
				<td style="width:33%; margin-right:0; margin-left : 0; padding-right: 0; padding-left: 0">
					<?php
					// on va arrondir les bords de la jauge on prend en compte les extrémités

					if($cpt ==1) //Pour celui tout à gauche (ici débutant)
					{
						if ($value['final_result'] != 0){
							//cela signfie que le niveau est acquis ou en cours d'acquisition.
							//Dans les deux cas, il y a un résultat à afficher dans la barre de progression
							echo "<div class=container style='border: 2px solid black; border-radius: 10px 0 0 10px'>
								<div class='skills progress' style='width : {$value['final_result']}%'>{$value['final_result']} %</div>
							</div>";
						}
						else
						{
							echo "<div class=container style='border: 2px solid black; border-radius: 10px 0 0 10px'>
						<div class='skills progress' style='width : 0%'></div>
						N/A</div>";	
						}
					}
					else if ($cpt == $taille_tab) //Pour celui tout à droite (ici avancé)
					{
						if($value['final_result'] != 0)
						{
							echo "<div class=container style='border: 2px solid black; border-radius: 10px 0 0 10px'>
								<div class='skills progress' style='width : {$value['final_result']}%'>{$value['final_result']} %</div>
							</div>";
						}
						else
						{
							echo "<div class=container style='border: 2px solid black; border-radius: 0 10px 10px 0'>
									<div class='skills progress' style='width : 0%'>
									</div>
								N/A</div>";	
						}
					}
					else //pour ceux au centre (ici intermédiaire)
					{
						if($value['final_result'] != 0)
						{
						echo "<div class=container style='border: 2px solid black'>
						<div class='skills progress' style='width : {$value['final_result']}%'>{$value['final_result']} %</div>";
						}
						else
						{
							echo "<div class=container style='border: 2px solid black;'>
						<div class='skills progress' style='width : 0%'></div>
						N/A</div>";	
						}
					}
					$cpt++;
					?>
				</td>
			<?php endforeach; ?>
			</table>


			<h1>Profil</h1>
			<h2>Mes informations</h2>
			<?php $sql="SELECT * FROM user where id={$_SESSION['id']}";
			$data=$bd->prepare($sql);
			$data->execute();
			while($afficher=$data->fetch()){
				$dateNais = aff_date($afficher['dateNais']);
				$niveau = aff_lvl($afficher['niveau']);
				echo "<p>Nom : {$afficher['nom']}<br>
				Prénom : {$afficher['prenom']}<br>
				Date de naissance : {$dateNais}<br>
				E-mail : {$afficher['mail']}<br>
				Nationnalité : {$afficher['nationalite']}<br>
				Niveau : {$niveau}</p>";
			}
			$data -> closeCursor();
			?>
			<h2>Mes r&eacute;sultats</h2>
			<?php 
			if($nb_record != 0)
			{
				echo "<caption> Informations sur vos évaluations effectuées </caption><table>\n";
				echo "<tr>\n<th>Niveau</th>\n<th>Nombre de réponses justes justes</th>\n<th>Nombres de questions</th><th>Faite le</th>\n</tr>\n";
				foreach ($eval_record as $key => $value) {
					$temps = aff_date($value['timestamp']);
					echo "<tr>\n <td>{$value['niveau']}</td>\n<td>{$value['nb_reponses_justes']}</td>\n<td>{$value['nb_questions']}</td>\n<td>{$temps}</td>\n</tr>\n";
				}
				echo "</table>\n";
			}
			else
			{
				echo "<p> Vous n'avez pas encore effectué d'évaluations ou une erreur s'est produite... </p>";
			}
			?>	
			<h2>Mes questions sur le forum</h2>
			<table>
			<?php $sql1="SELECT * FROM publicationf INNER JOIN user ON idPublieur=id where idPublieur={$_SESSION['id']}";
			$dataForum=$bd->prepare($sql1);
			$dataForum->execute();
			while($afficher=$dataForum->fetch()){
				echo "<tr><td><a href='../Forum/index.php?publication={$afficher['idPub']}'><div><p>{$afficher['sujet']}</p><p>Par {$afficher['nom']} {$afficher['prenom']} le {$afficher['date']}</p></div></a></td></tr>";
			}
			$dataForum -> closeCursor();
			?>
			</table>
		</div>
		<?php $bd=null; ?>
	</body>
</html>