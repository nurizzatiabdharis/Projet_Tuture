<h3>Poser des question</h3>
	<p>Pour poser des questions, utilise les expressions suivantes :</p>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($question as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>
	<p>Voici quelques exemples comment poser des questions :</p>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($question_exp as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>