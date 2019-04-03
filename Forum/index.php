<?php
session_start();
require('../outils/connexion.php');
require('../outils/base.php');
require('../outils/format.php');
require('./coding.php');
/*****
	Indication des tableaux :
		$listMesPubs    :  informations des publications de l'utilisateur 
		$listMesPubsRep :  informations des publications auxquels l'utilisateur a répondu (hors ses propres publications)
		$tabRecentPubs  :  informations des publications les plus récentes
		$tabRandPubs	:  informations des publications suggérées de manière aléatoires
*****/
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../css/site.css" />
		<link rel="icon" type="image/png" href="../img/entete1.png" />
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript" src="../js/menu_mobile.js"></script>
		<?php if (isset($_GET['publication']) && !empty($_GET['publication']) && isset($affTitle) && !empty($affTitle))
		{
			echo "<title>{$affTitle} - Forum</title>";
		}
		else
		{
			echo "<title>Forum</title>";
		}	
		?>
		<style type="text/css">
			textarea
			{
				resize : none;
				 /*width:100%;*/
			}
			textarea.text{
				height:200px;
			}
		</style>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript">
			jQuery(function($){
			$('.lien').hide();
			<?php if(isset($reponse)):?>
				$('#block1').show();
			<?php endif;?>
			});
			function fetchOne(clicked_id){
				var string_size = clicked_id.length;
				var get_number = clicked_id.substring(string_size-1,string_size);
				var nb_lien = 3;
				for (var i = 1; i <= nb_lien; i++) {
					if(i == get_number){	
						$('#block'+get_number).slideDown();
					}
					else{
						$('#block'+i).slideUp();	
					}
				}	
			}
		</script>
	</head>
	<body>
		<?php include('../outils/menu.php');?>
		<div id=corps>
			<h1> Forum </h1>
			<caption>Lien d'acc&egrave;s rapide</caption>
			<table id=fastlink class=maxWidth>
				<tr>
					<th><a href='#' id=link1 onclick="fetchOne(this.id)">Rechercher un fil de discussion</a></th>
					<th><a href='#' id=link2 onclick="fetchOne(this.id)">Créer un nouveau fil</a></th>
				</tr>
			</table>
			<div id=block1 class=lien>
				<table class="maxWidth">
					<tr>
						<th><label for=findFil>Inscrivez votre recherche</label></th>
					</tr>
					<tr>
						<form method='post' action=''>
						<td><input type=text id=findFil name=findFil style='width:100%;' placeholder="Rechercher..."></td>
						</form>
					</tr>
				</table>
					<?php
					if(isset($reponse) && !empty($reponse)){ 
						echo $reponse;
					} ?>
			</div>
			<div id=block2 class=lien>
				<table class=maxWidth>
					<tr>
						<th> Cr&eacute;er un nouveau fil </th>
					</tr>
					<form method="post" action=''>
					<tr>
						<td><textarea class="maxWidth" name=sujet id=sujet placeholder="Intitul&eacute; du sujet" required></textarea></td>
					</tr>
					<tr>
						<td><textarea class='text maxWidth' id=content name=content placeholder="Exprimez-vous !" required></textarea></td>
					</tr>
					<tr>
						<td><button type=submit name=fil id=submit1 class=envoi>Créer un nouveau fil !</button>
							<button type=reset>Reset</button></td>
					</tr>
					</form>
				</table>
			</div>
			<?php 
			if(isset($affpublication) && !empty($affpublication)){
				echo $affpublication;
				if(isset($affreponses) && !empty($affpublication)){
					foreach ($affreponses as $key => $value) {
						echo $value;
					}
				}
			}
			?>
			<?php if(isset($affpublication) && !empty($affpublication)):?>
				<table class=maxWidth style="border:1px solid black; margin-top:10px;">
					<tr>
						<th><label>R&eacute;pondre &agrave; ce sujet</label></th>
					</tr>
					<tr class=maxWidth style="padding-left:10px; padding-right:10px; text-align:center;">
						<form method="post" action=''>
						<td><textarea style='width: 92%; height : 50px;' type=text name=reponse id=reponse></textarea></td>
					</tr>
					<tr>
						<td>
							<button type=submit name=sendreponse id=sendreponse> Répondre </button>
							<button type=reset> Effacer </button>
						</form>
						</td>
					</tr>
				</table>
			<?php endif;?>
			<div class=inline>
				<div style="width:50%;" class=blockinline>
					<div id="My_publication">
						<h2> Vos Publications </h2>
						<?php if(isset($listMesPubs) && !empty($listMesPubs)):?>
							<table>
								<tr>
									<th> Sujet </th>
									<th> Date </th>
									<th> R&eacute;ponses </th>
								</tr>
							<?php foreach ($listMesPubs as $key => $value):?>	
								<tr>
									<td><?php echo "<a href='./index.php?publication={$value['idPub']}'> {$value['sujet']}</a>";?></td>
									<td><?php echo "le {$value['date']} &agrave; {$value['heure']}";?></td>
									<td><?php echo $countRep; ?></td>
								</tr>
							<?php endforeach; ?>
							</table>
						<?php endif; ?>
					</div>
					<div id="My_answers">
						<h2> Publications que vous avez comment&eacute; </h2>
						<?php if(isset($listMesPubsRep) && !empty($listMesPubsRep)){
							echo "<table><tr>
								<th> Sujet </th>
								<th> Date </th>
								<th> R&eacute;ponses </th>
							</tr>";
							foreach ($listMesPubsRep as $value){
								echo $value;
							}
							echo "</table>";
							}
							else{
								echo "<p>Vous n'avez pas fait de commentaires dans une publication</p>";
							}
						?>
					</div>
				</div>
				<div class=blockinline style="width:50%;">
					<div id="Recent_publications">
					<?php if(isset($tabRecentPubs) && !empty($tabRecentPubs)): ?>
						<h2> Les dernières publications </h2>
						<table>
							<tr>
								<th> Sujet </th>
								<th> Date </th>
								<th> R&eacute;ponses</th>
							</tr>
						<?php foreach ($tabRecentPubs as $key => $value):?>
							<tr>
								<td> <?php echo "<a href='./index.php?publication={$value['idPub']}'> {$value['sujet']} </a>";?> </td>
								<td> <?php echo 'le '.$value['date'].' '.$value['heure'];?> </td>
								<td> <?php echo $value['nb_reponses']; ?> </td>
							</tr>
						<?php endforeach; ?>
						</table>
					<?php endif;?>
					</div>
					<div id="Others">
						<?php if(isset($tabRandPubs) && !empty($tabRandPubs)): ?>
						<h2>Autres publications succeptibles de vous intéresser</h2>
						<table>
							<tr>
								<th> Sujet </th>
								<th> Date </th>
								<th> R&eacute;ponses</th>
							</tr>
							<?php foreach ($tabRandPubs as $key => $value):?>
							<tr>
								<td> <?php echo "<a href='./index.php?publication={$value['idPub']}'> {$value['sujet']} </a>";?> </td>
								<td> <?php echo 'le '.$value['date'].' '.$value['heure'];?> </td>
								<td> <?php echo $value['nb_reponses']; ?> </td>
							</tr>
							<?php endforeach; ?>
						</table>
						<?php endif;?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>