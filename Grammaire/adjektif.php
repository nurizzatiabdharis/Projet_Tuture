	<h2>Kata Adjektif / Kata Sifat (Les Les adjectifs)</h2>
	<p>On les utilise pour décrire l'état ou la nature d'un nom. En malais, les adjectifs n'accord jamais avec le sujet. <br>Les mots adjectifs sont divisés en plusieurs sous-catégories:</p>
	<table id=cours>
		<tr>
			<th>catégories</th>
			<th>Malais</th>
			<th>Français</th>
		</tr>
		<tr>
			<td rowspan="6">Sifat<br><i>(état)</i></td>
			<td>baru</td>
			<td>nouveau</td>
		</tr>
		<?php
			include("./tab_tatabahasa.php");
			foreach($sifat as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
		<tr>
			<td rowspan="6">Ukuran<br><i>(mésure)</i></td>
			<td>pendek</td>
			<td>court</td>
		</tr>
		<?php
			include("./tab_tatabahasa.php");
			foreach($ukuran as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
		<tr>
			<td rowspan="4">Jarak<br><i>(distance)</td>
			<td>dekat, hampir</td>
			<td>proche</td>
		</tr>
		<?php
			include("./tab_tatabahasa.php");
			foreach($jarak as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
		
		<tr>
			<td rowspan="9">Waktu/Cara<br><i>(temps/methode)</td>
			<td>lambat</td>
			<td>tard ou lent</td>
		</tr>
		<?php
			include("./tab_tatabahasa.php");
			foreach($Waktu as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
		
	</table>
	
	