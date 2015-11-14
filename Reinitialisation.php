<?php
	echo "boom";
	session_start();
	session_destroy();
	header('Location: Jeu.php');      
?>
