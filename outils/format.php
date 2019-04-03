<?php
	/********************************************

	Fichier qui regroupe les fonctions liées à l'affichage de certains éléments

	*********************************************/
	//afficher l'orthographe correcte 
	function aff_lvl($string)
	{
		switch ($string) {
			case 'nouveau':
				$afficher = "nouveau";
				break;
			case 'debutant':
				$afficher = "d&eacute;butant";
				break;
			case 'intermediaire':
				$afficher = "interm&eacute;diaire";
				break;
			case 'avance':
				$afficher = "avanc&eacute";
				break;
			default:
				$afficher=$string;
				break;
		}
		return $afficher;
	}

	//on va changer l'affichage du temps lorsqu'il est récupéré dans la BdD
	function aff_date($string)
	{
		if (strpos($string, "-") !== FALSE && strpos($string, ":") !== FALSE) {
			//la date et l'heure sont dans la meme chaine
			$timestamp = explode(" ", $string);
			$date = explode('-', $timestamp[0]);
			$time = explode(':', $timestamp[1]);
			$y = $date[0]; //année
			$d = $date[2]; //jour
			$m = $date[1]; //mois
			$h = $time[0];  //heures
			$mi = $time[1]; //minutes
			$s = $time[2];	//secondes
			$afficher =  $d.'/'.$m.'/'.$y.' &agrave; '.$h.' h '.$mi.' min';

		}
		else if(strpos($string, "-")){
			//seul la date est présente dans la chaine
			$date = explode("-", $string);
			$y = $date[0]; //année
			$d = $date[2]; //jour
			$m = $date[1]; //mois
			$afficher = $d.'/'.$m.'/'.$y;
		}
		else if(strpos($string, ":")){
			//seul l'heure est présente dans la chaine
			//dans ce cas je n'afficherai pas les secondes, c'est pas très intéressant
			$time = explode(":", $string);
			$h = $time[0];  //heures
			$mi = $time[1]; //minutes
			$s = $time[2];	//secondes
			$afficher = $h.' h '.$mi.' min';
		}
		else {
			//par defaut on retourne la chaine
			$afficher = $string;
		}
		return $afficher;
	}
?>