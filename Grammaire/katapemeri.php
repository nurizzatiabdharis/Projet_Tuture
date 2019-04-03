<h3>Les Auxiliaires - Kata Pemeri</h3>
	<p>Les verbes auxiliaire sont "etre" ou "avoir" en francais. Mais en Malais, une phrase n'est pas toujours besoin d'exprimer en utilsant "etre" ou "avoir".
	<br>En Malais, les verbes d'auxiliaire sont "ialah" ou "adalah" . Utilisation de ces deux mots sont un peu différent en malais que ceux de français
	<br>Faites attention aussi, plein du monde confondre l'utilisation "ialah" et "adalah"</p><br>
	<h4> ialah </h4>
	<p>1. On utilise cette règle: *** <strong>'ialah' + nom/objet/complements</strong>
	<p>2. Pour exprimer une définition
	<p>3. Pour une phrase où les sujets et les prédicats ont la même signification, c'est-à-dire, si on les fait inverser, la phrase a toujours le même sens</p>
	<p>Exemple: Angin <i>ialah</i> udara yang bergerak ---> Udara yang bergerak <i>ialah</i> angin</p>
	<p>4. Peut etre utiliser devant le mot "yang"
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($ialah as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>
	
	<h4>Adalah</h4>
	<p>1. On utilise 'adalah' suivi d'une adjectif ou <a href="http://malaisie.gautero.fr/Projet_TUT_Thomas/Grammaire/tatabahasa.php?categ=katasendi">d'une preposition (frasa sendi nama)</a>
	<p>2. Pour fournir une description ou une explication du sujet qui est déjà parlé avant</p>
	
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($adalah as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>
	
	<h4>Attention :</h4>
	<p>On ne peut pas utiliser kata pemeri 'ialah' et 'adalah' avec <a href="http://malaisie.gautero.fr/Projet_TUT_Thomas/Grammaire/tatabahasa.php?categ=negation">Négation (kata nafi) </a> sauf en utilisant cette régle: ***<strong>'adalah' + 'tidak' + 'adjectif'.</strong>
	<p>Voici un exemple d'une phrase qui mal utilise "adalah" au lieu "ialah" : Dia guru saya (1) | Dia adalah guru saya (2)</p>
	<p>Les deux phrases ont le meme traduction : Il est mon prof. Les deux phrases si vous dites aux malaisiens, ils comprennent. En ecriture, <strong>c'est faux !</strong></p>
	<p>Correction : Dia ialah guru saya.</p>
	