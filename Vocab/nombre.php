<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="./css/site.css" />
	<title>ExoTut.html</title>
	
</head>
	<body>
	<section>
		<p><h1>Les nombres - Nombor </h1></p>
		<p><h3>- Les nombres de base(0-10)</h3></p>

		<table id=cours>
			<?php	
				include("./tab.php");
				foreach($nb as $n => $val)
				{
					echo "<tr><td> $n </td>";
					echo "<td> $val </td></tr>";
				}
			?>
		</table>
		
		
		<p><h3>- Les nombres de 11 à 19</h3></p>
		<p> Pour ces nombres, on ajoute "belas" après le numero de base. c'est la même règle qu'en anglais (number + teen). <strong>Attention!!</strong> pour le nombre 11 : c'est 'sebelas' ce n'est pas 'satu belas'</p>
		<table id=cours>
		  <tr>
			<td>12</td>
			<td>Dua belas</td> 
		  </tr><tr>
			<td>13</td>
			<td>Tiga belas</td> 
		  </tr><tr>
			<td>14</td>
			<td>Empat belas</td> 
		  </tr>	
		</table>
		
	<p><h3>- Les dizaine</h3></p>
	
	<p>Pour chaque chiffre des dizaines, on ajoute le mots "puluh" apres le numero de base (nombor + puluh). c'est la même règle qu'en anglais (number + ty).<br>
	Ainsi, pour les nombres suivant:
	<p>Cent : Ratus</p>
	<p>Mille : Ribu </p>
	<p>Million : Juta </h2></p>
	<strong>Attention!! </strong><br>
	Pour la premiere nombre, toujours la meme regle que 10 et 11, on utilise toujours <strong>se</strong>+quelque chose, example:<br>
	pour 100 - c'est 'seratus' ce n'est pas 'satu ratus' <br>
	pour 1,000 - c'est 'seribu' ce n'est pas 'satu ribu' <br>
	pour 1,000,000 - c'est 'sejuta' ce n'est pas 'satu juta' <br>
	Exemple:
	<br>
	<table id=cours>
	  <tr>
		<td>20</td>
		<td>Dua puluh</td> 
	  </tr><tr>
		<td>30</td>
		<td>Tiga puluh</td> 
	  </tr><tr>
		<td>22</td>
		<td>Dua puluh dua</td> 
	  </tr><tr>
		<td>71</td>
		<td>Tujuh puluh satu</td> 
	  </tr><tr>
		<td>361</td>
		<td>Tiga ratus enam puluh satu</td> 
	  </tr><tr>
		<td>1361</td>
		<td>Seribu tiga ratus enam puluh satu</td> 
	  </tr> 
	</table>

	


	</section>
	</body>
</html>
