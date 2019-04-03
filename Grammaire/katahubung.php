<h3>Les conjonctions de coordination - Kata Hubung</h3>
	<p>Explication :  Elles relient des éléments de même fonction et souvent de même nature. 
	Ce qui suit est une liste des prépositions les plus utilisés en malais.</p>
	<p>Exemples :</p>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($conjonction as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>
	<p>Exemples de phrases:</p>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($conjonction_phrase as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>