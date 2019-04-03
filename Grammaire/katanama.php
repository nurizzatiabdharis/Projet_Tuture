<h3>Les Pronoms - Kata Nama</h3>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($pronom as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
</table>

<h3>Les Pronoms Possessifs - Kata Milik</h3>
	<p>Bonne nouvelle, en malais, il n'y a pas les pronoms possessifs pour feminin ou pluriel.</p>
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_tatabahasa.php");
			foreach($pronom_poss as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>