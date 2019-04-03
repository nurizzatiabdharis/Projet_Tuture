<section>
		<p>
			Dans cette partie vous pourrez apprendre les phrases basiques, celles que l'on utilise tous les jours.
		</p>

		<h1>Les Phrases Basique</h1>
	
	<table id=cours>
		<?php
			echo"<tr>
			<th>Malais</th>
			<th>Français</th>
			</tr>";
			include("./tab_conversation.php");
			foreach($phrasebasique as $n => $val)
			{
				
				echo"<tr>
						<td> $n </td>";
				echo"<td> $val </td>
					</tr>";
			}
		?>
	</table>
	
	<p>Maintenant, voici les conversations courantes. Essayez de les pratiquer en binôme pour les apprendre plus facilement.</p>

		<h1>Se presenter</h1>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Selamat pagi. Siapakah nama kamu ?</td>
				<td>Bonjour. Comment vous appelez-vous ?</td>
			</tr>
			<tr>
				<td>Thomas</td>
				<td>Selamat pagi. Nama saya Thomas. Siapakah nama kamu pula ?</td>
				<td>Bonjour. Je m'appelle Thomas. Et vous ?</td>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Nama saya Ali. Selamat berkenalan</td>
				<td>Je m'appelle Ali. Enchanté.</td>
			</tr>
		</table>

		<h1>Ça va ?</h1>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Apa khabar ?</td>
				<td>Comment ça va ?</td>
			</tr>
			<tr>
				<td>Thomas</td>
				<td>Khabar baik. Kamu ?</td>
				<td>Ça va bien. Et toi ?</td>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Khabar baik ****</td>
				<td>Ça va bien</td>
			</tr>
		</table>
		<p>****Si vous êtes malade, vous allez dire "Saya tidak sihat"</p>

		<h1>Où -> Mana</h1>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Di manakah kamu tinggal ?</td>
				<td>Où habitez-vous ?</td>
			</tr>
			<tr>
				<td>Thomas</td>
				<td>Saya tinggal di asrama universiti.</td>
				<td>J'habite dans la residence universitaire.</td>
			</tr>
		</table>
		<br>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Di manakah kamu?</td>
				<td>Où êtes-vous ?</td>
			</tr>
			<tr>
				<td>Thomas</td>
				<td>Saya berada di restoran universiti.</td>
				<td>Je suis dans le resto universitaire.</td>
			</tr>
		</table>

		<h1>Combien -> Berapa</h1>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Berapakah umur kamu ?</td>
				<td>Quel âge avez-vous ?</td>
			</tr>
			<tr>
				<td>Thomas</td>
				<td>Umur saya 28 tahun.</td>
				<td>J'ai 28 ans</td>
			</tr>
		</table>
		<p>Explication : Dans ce cas, quand on demande l'âge d'un quelqu'un, on n'utilise pas le verbe "avoir" en malais, comme en anglais.
		Translation direct le verbe avoir est "ada" . Il ne faut pas dire "Saya ada 28 tahun". Cette phrase est la traduction direct mais elle est fausse !
		</p>

		<h1>La nationalité -> Kewarganegaraan</h1>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Kamu berasal dari mana ?</td>
				<td>De quel pays viens-tu ?</td>
			</tr>
			<tr>
				<td>Thomas</td>
				<td>Saya berasal dari Perancis.</td>
				<td>Je viens de la France.</td>
			</tr>
		</table>

		<h1>Situation : Chez le poisonnier</h1>
		<table id=cours>
			<tr>
				<th colspan="2">Malais</th>
				<th>Français</th>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Pak cik, berapakah harga sekilo untuk ikan ini ?</td>
				<td>Monsieur, combien fait 1 kilo pour ce poisson ?</td>
			</tr>
			<tr>
				<td>Vendeur</td>
				<td>RM20 sekilo</td>
				<td>Ça fait RM20 pour 1 kilo</td>
			</tr>
			<tr>
				<td>Ali</td>
				<td>Saya mahu satu kilo setengah.</td>
				<td>J'en voudrais 1 kilo et demi.</td>
			</tr>
			<tr>
				<td>Vendeur</td>
				<td>Baiklah, jumlah semuanya RM30.</td>
				<td>D'accord, alors ça fait RM30.</td>
			</tr>
		</table>

	
</section>
