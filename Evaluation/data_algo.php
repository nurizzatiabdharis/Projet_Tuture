<?php
//fichier utilisé pour des variables utilisées dans plusieurs fichiers du répertoire evaluation
$type_exo_bdd = array(
					0 => 'QCM', 
					1 => 'txttrous', 
					2 => 'EXO_VOCAB',
				);
// print_r($type_exo_bdd);
// on doit alors sélectionner les colonnes de la table affiché
$cols_QCM = 'id, question, p1, p2, p3, p4, type';
$cols_txttrous = 'idTrou, questionTrou, type';
$cols_EXO_VOCAB =  'id, source, choix1, choix2, choix3, type';
$col_fetch_table = array(
							0 => $cols_QCM,
							1 => $cols_txttrous,
							2 => $cols_EXO_VOCAB,
						);
// print_r($col_fetch_table);
// attention !! le nom doit correspondre à la table de la bdd pour le type d'exercice concerné et les colonnes à la bonne table !!

?>