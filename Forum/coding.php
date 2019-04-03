<?php
/*************** legende :*************/
	/*** PHP : la variable $reponse contient la chaine de caractère qui constitue reponse de la recherche d'un sujet***/
	/*** Lorsque la variable $reponse existe, cela modifie le code javascript pour laisser la barre de recherche à l'écran
			par defaut visible à l'ecran  
		Les variables $_POST['findfil'], $_POST['fil'], $_POST['sendreponse'] sont les réponses des formulaires activant
			respectivement les formulaires  : de la recherche de publication, création d'un fil et création d'une répoonse
		La variable $_GET['publication'] est une variable visant à récupérer les informations d'une publication pour les afficher par le passage de l'id en paramètres dans l'URL
		 ***/ 
	// code
		/****************

							Barre de recherche

		****************/
		//$reponse : si l'id en URL ne correspond pas à un id de la publication de la BdD, il affichera un message comme quoi la publication n'a pas été trouvé. Si au contraire ça correspond, on va afficher les informations de la publication.
	if(isset($_POST['findFil'])){
		$search=htmlentities($_POST['findFil']);
		$sql="SELECT DISTINCT * FROM publicationf INNER JOIN user ON idPublieur=id WHERE sujet LIKE '%{$search}%'";
		$tab=array('search'=>$search);
		$find=$bd->prepare($sql);
		$find->execute($tab);
		$count=$find->rowCount();
		if($count==0){
			$reponse='<tr><td colspan=3> Aucun fil existant ne correspond &agrave; votre recherche </td></tr>';
		}
		else{
			$reponse='<table class="maxWidth" style="text-align:left">';
			while($aff=$find->fetch()){
				if(!isset($reponse) || empty($reponse)){
					$reponse="<tr><td><a href='./index.php?publication={$aff['idPub']}'><div><p>{$aff['sujet']}</p><p>Par {$aff['nom']} {$aff['prenom']} le {$aff['date']}</p></div></a></td></tr>";
				}
				else{
					$reponse=$reponse."<tr><td><a href='./index.php?publication={$aff['idPub']}'><div><p>{$aff['sujet']}</p><p>Par {$aff['nom']} {$aff['prenom']} le {$aff['date']}</p></div></a></td></tr>";
				}
			}
			$reponse=$reponse.'</table>';
		}
		$find -> closeCursor();
	}
		/******************** 

								creation d'un fil de discussion 

		*********************/
	if(isset($_POST['fil']))
	{
		$sujet=htmlentities($_POST['sujet']);
		$content=nl2br(htmlentities($_POST['content']));
		$date=date('Y-m-d');
		$heure=date('H:i');
		try{
		$sql="INSERT INTO publicationf (idPublieur, date, heure, sujet, Contenu) VALUES (:publieur, :date, :heure, :sujet, :contenu)";
		$tab=array('publieur' => $_SESSION['id'], 
			'date' => $date,
			'heure' => $heure,
			'sujet' => $sujet,
			'contenu' => $content);
		$createlink = $bd ->prepare($sql);
		$createlink->execute($tab);
		$createlink -> closeCursor();
		}
		catch(Exception $e){
			echo $e;
		}
	}
		/*********************

		 						création d'un commentaire

		 *********************/
	if(isset($_POST['sendreponse']) && isset($_GET['publication']) && !empty($_GET['publication'])){
		if(empty($_POST['reponse']) || !isset($_POST['reponse'])){
			$error='Vous ne pouvez envoyer une réponse vide !';
		}
		else {
			try{
				$auteur=$_SESSION['id'];
				$date=date('Y-m-j');
				$heure=date('H:i');
				$contenu=nl2br(htmlentities($_POST['reponse']));
				$pubtarget=htmlentities($_GET['publication']);
				$sql="INSERT INTO reponsef (idUserResp, idPubResp, dateRep, heureRep, contenuRep) VALUES (:auteur, :pubtarget, :date, :heure, :contenu)";
				$tab = array('auteur' => $auteur, 'pubtarget' => $pubtarget, 'date' => $date, 'heure' => $heure, 'contenu' => $contenu);
				$newrep=$bd->prepare($sql);
				$newrep->execute($tab);
				$newrep->closeCursor();
			}
			catch(Exception $e)
			{
				echo $e;
			}
		}
	}
	/********************

							affichage d'une publication ciblée (avec un paramètre dans l'URL)

	********************/
	if(isset($_GET['publication']) && !empty($_GET['publication'])){
		$idpub=htmlentities($_GET['publication']);	
		$sql="SELECT * from publicationf INNER JOIN user ON idPublieur=id WHERE idPub=:idpub"; 
		$tab=array('idpub'=>$idpub);
		$pub=$bd->prepare($sql);
		$pub->execute($tab);
		$exist=$pub->rowCount();
		if($exist==1){
			//partie affichage d'une publication
			while($aff=$pub->fetch()){
				$affTitle=$aff['sujet'];
				$date = aff_date($aff['date']);
				$heure = aff_date($aff['heure']);
				$affpublication="<div style='border:1px solid black; margin-top:10px;'>
					<table style='width:100%;'>
						<tr>
							<th style='width:50%; text-align: left'>
								{$aff['nom']} {$aff['prenom']}
							</th>
							<th style='width:50%; text-align: right'>
								Le {$date} &agrave {$heure}
							</th>
						</tr>
						<tr>
							<td colspan='2'>
								<h3 style='padding-left: 20px'>{$aff['sujet']}</h3>
								<p style='width:100%; padding-left: 40px; padding-right: 40px; text-align:left'>
									{$aff['Contenu']}
								</p>
							</td>
						<tr>
					</table>
				</div>";
			}
			//partie affichage des commentaires
			$sql1="SELECT * FROM reponsef INNER JOIN user ON idUserResp=id WHERE idPubResp=:idpub ORDER BY dateRep, heureRep";
			$rep=$bd->prepare($sql1);
			$rep->execute($tab);
			$countRep=$rep->rowCount();
			while($affrep=$rep->fetch()){
				$dateRep = aff_date($affrep['dateRep']);
				$heureRep = aff_date($affrep['heureRep']);
				$affreponses[]='<div style="border:1px solid black; margin-top:10px;">
					<table style="width:100%;">
						<tr>
							<th style="width:50%; text-align: left">'.$affrep['nom'].' '.$affrep['prenom'].'</th>
							<th style="width:50%; text-align: right">Le '.$dateRep.' &agrave '.$heureRep.'</th>
						</tr>
						<tr>
							<td colspan="2">
								<p style="width:100%; padding-left: 40px; padding-right: 40px">'.$affrep['contenuRep'].'</p></div>
							</td>
						</tr>
					</table>';
			}
		}
		else{
			$affpublication='<p>publication non trouvée</p>';
		}
		$pub->closeCursor();
	}

	/****************

						Affichage constant des publications
	
	*****************/
	//affichage des publications crées par l'utilisateur
	$reqAffMesPubs="SELECT * FROM publicationf WHERE idPublieur=:iduser";
	$MesPubs = $bd ->prepare($reqAffMesPubs);
	$ptrUser=array('iduser' => $_SESSION['id']);
	$MesPubs->execute($ptrUser);
	$count = 0;
	while($fetchpub=$MesPubs->fetch()){
		$countRepSQL="SELECT idUserResp FROM reponsef WHERE idPubResp={$fetchpub['idPub']}";
		$countRepREQ=$bd->prepare($countRepSQL);
		$countRepREQ->execute();
		$countRep=$countRepREQ->rowCount();
		$listMesPubs[$count]['idPub'] = $fetchpub['idPub'];
		$listMesPubs[$count]['sujet'] = $fetchpub['sujet'];
		$listMesPubs[$count]['date'] = aff_date($fetchpub['date']);
		$listMesPubs[$count]['heure'] = aff_date($fetchpub['heure']);
		$listMesPubs[$count]['nb_reponses'] = $countRep;
		$count++;
		$countRepREQ->closeCursor();
	}
	$MesPubs->closeCursor();
	//affichage des publications auxquels l'utilisateur a répondu (différentes de celles qu'il a créé)
	$reqPtrPubRep="SELECT DISTINCT idPubResp FROM reponsef  WHERE idUserResp=:iduser";
	$MesPubRep = $bd -> prepare($reqPtrPubRep);
	$MesPubRep->execute($ptrUser);
		while($ptrPubRep=$MesPubRep->fetch()){
			//compter le nombre de réponses par publication 
			$countRepSQL="SELECT idUserResp FROM reponsef INNER JOIN publicationf ON idPubResp=idPub WHERE idPub={$ptrPubRep['idPubResp']} AND idPublieur NOT LIKE {$_SESSION['id']}";
			$countRepREQ=$bd->prepare($countRepSQL);
			$countRepREQ->execute();
			$countRep=$countRepREQ->rowCount();
			$countRepREQ->closeCursor();
			$reqAffPubRep="SELECT idPub,sujet, date, heure FROM publicationf WHERE idPub={$ptrPubRep['idPubResp']} AND idPublieur NOT LIKE {$_SESSION['id']}";
			$AffPubRep=$bd->prepare($reqAffPubRep);
			$AffPubRep->execute();
			$counter=$AffPubRep->rowCount();
			$listMesPubsRep = array();
			while($fetchPubRep=$AffPubRep->fetch()){
				$listMesPubsRep[]="<tr><td><a href='./index.php?publication={$fetchPubRep['idPub']}'> {$fetchPubRep['sujet']}</a></td><td>le {$fetchPubRep['date']} &agrave {$fetchPubRep['heure']}</td><td>{$countRep}</td></tr>";
		}
	}
	$MesPubRep->closeCursor();
	/*******************

							affichage des dernières pub publications ajoutées

	********************/
	$reqRecentPub = "SELECT * FROM publicationf ORDER BY date DESC,heure DESC";
	$tabRecentPubs = array();
	$RecentPubs = $bd -> prepare($reqRecentPub);
	$RecentPubs -> execute();
	$count=0;
	$nbAffPub = 5; //nombre de publication que l'on veut afficher
	$count_NbPubs = $RecentPubs -> rowCount();
	if($count_NbPubs < $nbAffPub)
	{
		$nbAffPub = $count_NbPubs;
	}
	while($getInfoRecentPub = $RecentPubs -> fetch())
	{
		if($count < $nbAffPub)
		{
			$countRepSQL="SELECT idUserResp FROM reponsef WHERE idPubResp={$getInfoRecentPub['idPub']}";
			$countRepREQ = $bd -> prepare($countRepSQL);
			$countRepREQ -> execute();
			$nb_reponses = $countRepREQ -> rowCount();
			$countRepREQ->closeCursor();
			$tabRecentPubs[$count]['idPub'] = $getInfoRecentPub['idPub'];
			$tabRecentPubs[$count]['sujet'] = $getInfoRecentPub['sujet'];
			$tabRecentPubs[$count]['date'] = aff_date($getInfoRecentPub['date']);
			$tabRecentPubs[$count]['heure'] = aff_date($getInfoRecentPub['heure']);
			$tabRecentPubs[$count]['nb_reponses'] = $nb_reponses;
		}
		$count++;
	}
	/********************

					affichage de publication aléatoires

	********************/
	$reqRandPub = "SELECT * FROM publicationf ORDER BY RAND() LIMIT 5";
	$tabRandPubs = array();
	$RandPubs = $bd -> prepare($reqRandPub);
	$RandPubs -> execute();
	while($getInfoRandPub = $RandPubs -> fetch())
	{
		$countRepSQL="SELECT idUserResp FROM reponsef WHERE idPubResp={$getInfoRandPub['idPub']}";
		$countRepREQ = $bd -> prepare($countRepSQL);
		$countRepREQ -> execute();
		$nb_reponses = $countRepREQ -> rowCount();
		$countRepREQ->closeCursor();
		$tabRandPubs[$count]['idPub'] = $getInfoRandPub['idPub'];
		$tabRandPubs[$count]['sujet'] = $getInfoRandPub['sujet'];
		$tabRandPubs[$count]['date'] = aff_date($getInfoRandPub['date']);
		$tabRandPubs[$count]['heure'] = aff_date($getInfoRandPub['heure']);
		$tabRandPubs[$count]['nb_reponses'] = $nb_reponses;
		$count++;
	}
	$bd=null;
?>