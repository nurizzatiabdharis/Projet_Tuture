	<h2>La Preposition - Kata Sendi</h2>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($sendi as $n => $val)
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
			foreach($sendi_phrase as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>