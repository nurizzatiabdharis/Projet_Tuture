<?php
session_start();
include('../outils/connexion.php'); //only registered user have access
include('../outils/base.php');
include('./data_algo.php');
include('./fonctions.php');
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/site.css" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<title>Evaluation</title>
		<style type="text/css">
			#progress{
				text-align:right;
				width: 60%;
				background:green;
			}

			/* The Modal (background) */
			.modal {
			    display: none; /* Hidden by default */
			    position: fixed; /* Stay in place */
			    z-index: 1; /* Sit on top */
			    padding-top: 100px; /* Location of the box */
			    left: 0;
			    top: 0;
			    width: 100%; /* Full width */
			    height: 100%; /* Full height */
			    overflow: auto; /* Enable scroll if needed */
			    background-color: rgb(0,0,0); /* Fallback color */
			    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			}

			/* Modal Content */
			.modal-content {
			    background-color: #fefefe;
			    margin: auto;
			    padding: 20px;
			    border: 1px solid #888;
			    width: 80%;
			}

			/* The Close Button */
			.close {
			    color: #aaaaaa;
			    float: right;
			    font-size: 28px;
			    font-weight: bold;
			}

			.close:hover,
			.close:focus {
			    color: #000;
			    text-decoration: none;
			    cursor: pointer;
			}
		</style>
	</head>
	<body>
		<?php include('../outils/menu.php');?>
		<div id=corps>
			<h1>Penilaian (Evaluation)</h1>
			<h3>Tests de niveaux : testez votre niveau en malais.<br>Faites notre test gratuit et découvrez où vous vous situez aujourd’hui</h3>
			<p>Le test porte sur votre connaissance de la grammaire, du vocabulaire et de phrases types à utiliser dans les conversations générales et professionnelles.</p>

			<?php
				$niveau_user=$_SESSION['niveau'];

				$max_essai_debutant=3;
				$max_essai_intermediaire=5;
				$max_essai_avance=7;

				//4 cas possible : nouveau, debutant, intermediaire et avance
				switch ($niveau_user) {
			    case 'nouveau': //----------------------------------cas si l'utilisateur est nouveau---------------------------------------------
					$sql = "SELECT * FROM record_evaluation WHERE idUser = {$_SESSION['id']} AND niveau='debutant'"; //lancer une requete sql pour savoir combien d'essai a ete fait pour niveau debutant
					$req = $bd->prepare($sql);
					$req->execute();
					$data_record=$req->fetchall();
					$req->closeCursor();

					$nb_essai=count($data_record);
					$essai_reste=$max_essai_debutant-$nb_essai;
					echo "<a href=\"./evaluation_debutant.php\" class=\"button button1\">Débutants</a>";
					echo "<a href=\"#\"class=\"button button2\" id=\"btnError1\" >Intermédiaire</a>";
					echo "<a href=\"#\" class=\"button button3\" id=\"btnError2\" >Avancé</a><br><br>";

					echo "<p><strong>Vous avez $essai_reste essai pour l'evaluation debutant.<strong><p>";
			      break;
			    case 'debutant'://----------------------------------cas si l'utilisateur est debutant---------------------------------------------
					$sql = "SELECT * FROM record_evaluation WHERE idUser = {$_SESSION['id']} AND niveau='intermediaire'"; //lancer une requete sql pour savoir combien d'essai a ete fait pour niveau intermediaire
					$req = $bd->prepare($sql);
					$req->execute();
					$data_record=$req->fetchall();
					$req->closeCursor();

					$nb_essai=count($data_record);
					$essai_reste=$max_essai_intermediaire-$nb_essai;
					echo "<a href=\"./evaluation_debutant.php\" class=\"button button1\">Débutants</a>";
					echo "<a href=\"./evaluation_moyenne.php\"class=\"button button2\">Intermédiaire</a>";
					echo "<a href=\"./evaluation_avancee.php\" class=\"button button3\" id=\"btnError2\">Avancé</a><br><br>";

					echo "<p><strong>Vous avez $essai_reste essai pour l'evaluation intermediaire.<strong><p>";
			      break;
			    case 'intermediaire'://----------------------------------cas si l'utilisateur est intermediaire---------------------------------------------
					$sql = "SELECT * FROM record_evaluation WHERE idUser = {$_SESSION['id']} AND niveau='avance'"; //lancer une requete sql pour savoir combien d'essai a ete fait pour niveau avance
					$req = $bd->prepare($sql);
					$req->execute();
					$data_record=$req->fetchall();
					$req->closeCursor();

					$nb_essai=count($data_record);
					$essai_reste=$max_essai_avance-$nb_essai;
					echo "<a href=\"./evaluation_debutant.php\" class=\"button button1\">Débutants</a>";
					echo "<a href=\"./evaluation_moyenne.php\"class=\"button button2\">Intermédiaire</a>";
					echo "<a href=\"./evaluation_avancee.php\" class=\"button button3\">Avancé</a><br><br>";

					echo "<p><strong>Vous avez $essai_reste essai pour l'evaluation avance.<strong><p>";
			      break;
			    case 'avance'://----------------------------------cas si l'utilisateur est avance---------------------------------------------
					echo "<a href=\"./evaluation_debutant.php\" class=\"button button1\">Débutants</a>";
				 	echo "<a href=\"./evaluation_moyenne.php\"class=\"button button2\">Intermédiaire</a>";
				 	echo "<a href=\"./evaluation_avancee.php\" class=\"button button3\">Avancé</a><br><br>";

					echo "<p><strong>Vous etes tres pro !<strong><p>";
			    default:
			      //echo "Erreur";
			      break;
			  }

			?>

			<!-- The Modal -->
			<div id="myModal" class="modal">

			  <!-- Modal content -->
			  <div class="modal-content">
			    <span class="close">&times;</span>
			    <p>Vous n'avez pas le droit pout passer au niveau suivant car votre niveau est insuffisance.</p>
			  </div>

			</div>

			<script>
			// Get the modal
			var modal = document.getElementById('myModal');

			// Get the button that opens the modal
			var btn1 = document.getElementById('btnError1');
			var btn2 = document.getElementById('btnError2');
			// Get the <span> element that closes the modal
			var span = document.getElementsByClassName("close")[0];

			// When the user clicks the button, open the modal
			btn1.onclick = function() {
			    modal.style.display = "block";
			}

			btn2.onclick = function() {
			    modal.style.display = "block";
			}
			// When the user clicks on <span> (x), close the modal
			span.onclick = function() {
			    modal.style.display = "none";
			}

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
			    if (event.target == modal) {
			        modal.style.display = "none";
			    }
			}
			</script>

			<img src="chart.jpg" alt="chart" height="20%" width="20%">

		</div>
	</body>
</html>
