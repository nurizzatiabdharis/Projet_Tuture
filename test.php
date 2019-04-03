<?php
	session_start();
	include('./outils/base.php');
	//inscription
	if(isset($_POST['ins'])){ //la condition est testé par le nom du bouton d'envoi 'ins'
		$nom=htmlentities($_POST['nom']);		//variable contenant le nom de l'inscrit
		$prenom=htmlentities($_POST['prenom']); //variable contenant le prénom de l'inscrit
		$mail=htmlentities($_POST['mail']); 	//variable contenant le mail de l'inscrit
		$mdp=htmlentities($_POST['mdp']);		//variable contenant le mot de passe de l'inscrit
		$mdp=sha1($mdp);						//on crypte le mot de passe pour eviter de l'enregistrer en clair
		$date=htmlentities($_POST['date']);		////variable contenant la date d'anniversaire de l'incrit
		$nationalite=htmlentities($_POST['nationalite']); //variable contenant la nationalité de l'inscrit
		$civil=$_POST['civil'];					//variable contenant le sexe de l'inscrit
		// tester si le mail appartient déjà à un compte
		$reqmail=$bd->prepare("SELECT * FROM user WHERE mail=:mail");
		$reqmail->execute(array('mail'=>$mail));
		$redondance= $reqmail -> rowCount();
		$reqmail->CloseCursor();
		if($redondance==0)
		{
			/*Si toutes les informations sont indiquées et si il n'y a pas de redondance dans le mail avec la bdd*/
			$sql="INSERT INTO user (nom, prenom, civilite, dateNais, mail, mdp, nationalite ) VALUES (:nom, :prenom, :civil, :date, :mail, :mdp, :nationalite)";
			$tabins=array('nom'=> $nom, 'prenom'=>$prenom, 'civil'=>$civil, 'date'=>$date, 'mail'=>$mail, 'mdp'=>$mdp, 'nationalite'=>$nationalite);
			$ins=$bd->prepare($sql);
			$ins->execute($tabins);
			$ins->CloseCursor();
			// on vérifie que l'utilisateur est bien inscrit dans la base de données
			$verif='SELECT * FROM user WHERE mail = :mail';
			$tab = array('mail'=>$mail);
			$check=$bd->prepare($verif);
			$check->execute($tab);		
			$reussite=$check->rowCount();
			$check->CloseCursor();

			if($reussite==1)
			{	
				//inscription ok
				$bd=null;
				$_SESSION['id']=$attribuer['id'];
				$_SESSION['niveau']=$attribuer['niveau'];
				header ("Location: ./Profil/profil.php");
				exit();
			}
			else
			{

				$bd=null;
				//pas inscrit
				header('Location: ./index.php?error=nosuscribe');
				exit();
			}
		}
		else
		{/*On renvoie sur la page connexion si le mail est redondant*/
			$bd=null;
			header('Location: ./index.php?error=mailredond');
			exit();					
		}
	}
	//connexion
	if(isset($_POST['co'])){ //la condition est testé par le nom du bouton d'envoi 'co'
		$mail=htmlentities($_POST['mail']);  //protection contre les entités html & injections SQL
		$mdp=htmlentities($_POST['mdp']);
		$mdp=sha1($mdp); 						//hashage du mdp en sha1 pour le faire correspondre à la base de données
		$sql="SELECT id, niveau FROM user WHERE mail=:mail AND mdp=:mdp";
		$co=$bd->prepare($sql);
		$tab=array('mail'=>$mail, 'mdp' => $mdp);
		$co->execute($tab);
		$exist=$co->rowCount();
		if($exist==1)
		{
				//ajouter variable de session
				session_start();
				while($attribuer = $co -> fetch())
				{
					$_SESSION['id']=$attribuer['id'];
					$_SESSION['niveau']=$attribuer['niveau'];
				}
				$co->CloseCursor();
				$bd=null;
				header('Location: ./Profil/profil.php');
				exit;
		}
		else
		{
			$co->CloseCursor();
			$bd=null;
			header('Location: ./index.php?error=connexion');
			exit;
			//renvoyer a un lien attestant de l'echec de connexion
		}
	}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="view" content="width=device-width">
		<link rel="icon" type="image/png" href="./img/entete1.png">
		<link rel="stylesheet"  media="screen" href="./css/site.css" />
		<link rel="stylesheet"  media="screen" href="./css/accueil.css" />
		<title>Accueil - Malais Mudah</title>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript" src='http://malaisie.gautero.fr/Projet_TUT_Thomas/js/cookiechoices.js'></script>
		<script>document.addEventListener('DOMContentLoaded', function(event){cookieChoices.showCookieConsentBar('Ce site utilise des cookies pour vous offrir le meilleur service. En poursuivant votre navigation, vous acceptez l\'utilisation des cookies.', 'J\'accepte', 'En savoir plus', 'http://www.example.com/mentions-legales/');});</script>
		<script type="text/javascript" src='./js/index.js'></script>
	</head>
	<body>
		<table id='forme'>
			<tr id=logo>
				<td>
					<div>
					<img id=imglogo src="./img/WallMalFr.png" alt="Drapeaux malais et fran&ccedil;ais accol&eacute;s" height="70%" width="70%" title="drapeaux malais et fran&ccedil;ais accol&eacute;s" />
					</div>
				</td>
			</tr>
		</table>
		<section id=main>
			<div id="col-1">
						<table id=accueil>
							<tr><center><img id=imglogo src="./img/entete1.png" alt="malaismudah" height="50%" width="50%" title="malaismudah" /></center></tr>
							<tr>
								<td colspan=2><a href='./Intro/intro.php'><button class=menu id=acmal>D&eacute;couverte de la Malaisie</button></a></td>
							</tr>
							<tr>
								<td><a href='./Grammaire/tatabahasa.php'><button class=menu id=acgram>Grammaire</button></a></td>
								<td><a href='./Vocab/vocab.php'><button class=menu id=acvocab>Vocabulaire</button></a></td>
							</tr>
							<tr>
								<td><a href='./Exo/exo.php'><button class=menu id=acex>Exercice</button></a></td>
								<td><a href='./Evaluation/evaluation.php'><button class=menu id=aceval>Evaluation</button></a></td>
							</tr>
							<tr>
								<td colspan=2><a href='./Forum/'><button class=menu id=acforum>Forum</button></a></td>
							</tr>
						</table>
					</div>
			<div id="col-2">
						<div>
							<div class=commentaire>
								<p> Bienvenue sur le site !</p>
								<p> Ce site web vous permettra d'apprendre le malais à votre rythme et gratuitement. </br>
								L'accès au cours est visible par tous. </br>
								Si vous souhaitez vous exercer, vous évaluer ou bien poser des questions sur le forum, ils vous suffit de vous inscrire juste en dessous ou bien de vous loger avec votre compte unice. </p>
								<?php if (isset($respond)){
									echo $respond;
								}
								?>
							</div>
							<table id=auth>
								<tr>
									<td><a href='#'><button class=menu id=co>Connexion</button></a></td>
								</tr>
								<tr>
									<td><a href='#'><button class=menu id=ins>Inscription</button></a></td>
								</tr>
							</table>
						</div>
				
				<div id=form> 
					<div id=formIns>
						<h1>Infos</h1>
						<form method=post action=''>
						<div class="row">
							<div class="col-25">
								<label for=civil>Civilit&eacute;</label>
							</div>
							<div class="col-75">
								<select name=civil id=civil>
									<option value=1>M.</option>
									<option value=0>Mme.</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for=nom>Nom</label>
							</div>
							<div class="col-75">
								<input type=text name=nom id=nom required />
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for=prenom>Prenom</label>
							</div>
							<div class="col-75">
								<input type=text name=prenom id=prenom required />
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for=date>Date de naissance</label>
							</div>
							<div class="col-75">
								<input type=date name=date id=date required/>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for=email>E-mail</label>
							</div>
							<div class="col-75">
								<input type=email name=mail id=mail required/>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for=mdp>Mot de passe</label>
							</div>
							<div class="col-75">
								<input type=password name=mdp id=mdp required/>
							</div>
						</div>
						<div class="row">
							<div class="col-25">
								<label for=nationalite>Nationnalité</label>
							</div>
							<div class="col-75">
								<input type=text name=nationalite id=nationalite required />
							</div>	
						</div>
						<br><br>
						<button type=submit id="btninfo" name=ins>S'inscrire</button>
						<button type=reset id="btninfo">Reset</button>
						</form>
					</div>
					<div id=formCo>
						<h1>Connexion</h1>
						<form method=post action=''>
						<div class="row">
							<div class="col-25">
								<label for=mail>Email</label>
							</div>	
							<div class="col-75">
								<input type=email name=mail id=mail required>
							</div>	
						</div>
						<div class="row">
							<div class="col-25">
								<label for=mdp> Mot de passe </label>
							</div>
							<div class="col-75">
								<input type=password name=mdp id=mdp required>
							</div>
						</div>
						<br><br>		
						<button type=submit id="btninfo" name=co>Connexion</button>
						<button type=reset id="btninfo">Reset</button>
						</form>
					</div>
				</div>
				<div class='bottom-container maxWidth'>
					<?php
					 if(isset($_GET['error']))
					{
						if ($_GET['error']=='redirect')
						{
							echo "<div id='warning' class='inside_bottom-container maxWidth'>
								<p style='margin:5px 0 15px 15px; float: left'>Vous devez vous connecter pour pouvoir accèder à cette page</p>
								<p style='margin:5px 15px 15px 0; float: right'><button id='close'>Fermer</button></p>
							</div>";
						}
						
						if ($_GET['error']=='connexion'){
							"<div id='warning' class='inside_bottom-container maxWidth'>
								<p style='margin:5px 0 15px 15px; float: left'>Mauvaise adresse e-mail ou mauvais mot de passe inscrit. Veuillez réessayer</p>
								<p style='margin:5px 15px 15px 0; float: right'><button id='close'>Fermer</button></p>
							</div>";	
						}
					} ?>
				</div>
			</div>
		</section>
	</body>
</html>