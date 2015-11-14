<?php
	// Script pour relancer une partie
	session_start();
	session_destroy();
	header('Location: Jeu.php');      
?>
