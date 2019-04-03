<table id='forme'>
			<tr id=logo>
				<td>
					<div>
						<a href="http://malaisie.gautero.fr/Malais_Mudah/"><img id=imglogo src="../img/entete1.png" alt="Drapeaux malais et fran&ccedil;ais accol&eacute;s" height="40%" width="40%" title="drapeaux malais et fran&ccedil;ais accol&eacute;s"/></a>
					</div>
				</td>
			</tr>
		</table>
		<table id=header>
			<tr id="access_site">
				<td><a href='../Intro/intro.php'><button class=menu id=mal>La Malaisie</button></a></td>
				<td><a href='../Grammaire/tatabahasa.php'><button class=menu id=gram>Grammaire</button></a></td>
				<td><a href='../Vocab/vocab.php'><button class=menu id=vocab>Vocabulaire</button></a></td>
				<td><a href='../Exo/exo.php'><button class=menu id=ex>Exercice</button></a></td>
				<td><a href='../Evaluation/evaluation.php'><button class=menu id=eval>Evaluation</button></a></td>
				<td><a href='../Forum/'><button class=menu id=forum>Forum</button></a></td>
				<td><a href='../Profil/profil.php'><button class=menu id=perso>Profil</button></a></td>
			</tr>
			<tr id="line_acces">
				<td><a href='#' onclick="menu(this.id)"><img src="../img/button_menu.png" style="width: 50px; height: 50px;"></a></td>
			</tr>
		</table>
		<?php if(isset($_SESSION['id'])): ?>
		<div id=deco>
			<a href='../outils/logout.php'><img id=deconnex src='../img/deco.png' alt='D&eacute;connexion' title='D&eacute;connexion' /></a>
		</div>
		<?php endif; ?>
