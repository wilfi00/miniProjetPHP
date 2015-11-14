<?php
	require_once ("Plateau.php");
	session_start();

	// Coordonnées de la case de départ
	$x = $_SESSION['sauvegardeX'];
	$y = $_SESSION['sauvegardeY'];	
	// Coordonnées de la case d'arrivée
	$x2 = $_SESSION['sauvegardeX2'];
	$y2 = $_SESSION['sauvegardeY2'];
	// Joueur qui annule le coup
	$j = $_SESSION['sauvegardeJ'];

	// Modification des variables de session
	$_SESSION['plateau'] -> getCellulePlateau($x, $y) -> setCaseJoueur($j);
	$_SESSION['plateau'] -> getCellulePlateau($x2, $y2) -> setCaseJoueur(null);
	$_SESSION['tourDeJeu'] = $j;
	//$_SESSION['plateau'] = $_SESSION['sauvegarde'];
	header('Location: Jeu.php');      
?>
