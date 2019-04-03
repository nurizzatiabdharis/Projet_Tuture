<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/site.css" />
	<link rel="icon" type="image/png" href="../img/entete1.png" />
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
	<script type="text/javascript" src="../js/menu_mobile.js"></script>
	<title>Exercice</title>
</head>
	<body>
		<?php include('../outils/menu.php');?>
		<div id=corps>
				<h1>Latihan (Exercice)</h1>
			<h3>Nous vous proposons des exercices gratuits! Les exercices proposés sont basés sur le cours.</h3>
			<h3>Choisissez l'exercice dans le menu ci-dessus: </h3>

			<div class="dropdown">
			<button onclick="myFunction()" class="dropbtn">Grammaire</button><br>
			  <div id="myDropdown" class="dropdown-content">
				<a href="./exo_qcm.php">Exercice 1</a>
				<a href="./exo_trou.php">Exercice 2</a>
				<a href="./exo_gram_org_mot.php">Exercice 3</a>
			  </div>
			</div>

			<div class="dropdown">
			<button onclick="myFunction2()" class="dropbtn">Vocabulaire</button><br>
			  <div id="myDropdown2" class="dropdown-content">
				<a href="./exo_vocab.php">Exercice 1</a>
				<a href="./exo_vocab_audio.php">Exercice 2</a>
			  </div>
			</div>

			<div class="dropdown">
			<button onclick="myFunction3()" class="dropbtn">Conversation</button><br>
			  <div id="myDropdown3" class="dropdown-content">
				<a href="./exo_conv1.php">Exercice 1</a>
				<a href="./exo_conv2.php">Exercice 2</a>
			  </div>
			</div>
			<br><br><br><br><img src="enfant2.gif" alt="chart" height="20%" width="20%">

		</div>
		<script>
	/* When the user clicks on the button,
	toggle between hiding and showing the dropdown content */
	function myFunction() {
		document.getElementById("myDropdown").classList.toggle("show");
	}
	// Close the dropdown if the user clicks outside of it
	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}

	function myFunction2() {
		document.getElementById("myDropdown2").classList.toggle("show");
	}

	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}

	function myFunction3() {
		document.getElementById("myDropdown3").classList.toggle("show");
	}

	window.onclick = function(event) {
	  if (!event.target.matches('.dropbtn')) {

		var dropdowns = document.getElementsByClassName("dropdown-content");
		var i;
		for (i = 0; i < dropdowns.length; i++) {
		  var openDropdown = dropdowns[i];
		  if (openDropdown.classList.contains('show')) {
			openDropdown.classList.remove('show');
		  }
		}
	  }
	}
	</script>
	</body>
</html>
