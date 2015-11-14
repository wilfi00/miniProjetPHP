<?php
	/*
		Gestion des tours de jeu avec $_SESSION['tourDeJeu'] en symbolisant les tours avec j1 et j2 et avec les joueurs fictifs qui représentent les tours où on clique pour effectuer un déplacement sur une case vide avec j3 (pour le joueur1) et j4 (pour le joueur2).

		Algorithme : 
		tourDeJeu = j1
		Tant que un des 2 joueurs n'a pas gagné : 
			Si c'est le tour de j1
				Le Joueur1 joue en cliquant sur un de ses pions -- tourDeJeu = j3
				On passe au tour de j3
					Le joueur1 joue en cliquant sur un des déplacements possible -- tourDeJeu = j2
			Si c'est le tour de j2
				Le Joueur2 joue en cliquant sur un de ses pions -- tourDeJeu = j4
				On passe au tour de j4
					Le joueur2 joue en cliquant sur un des déplacements possible -- tourDeJeu = j1
	*/

	require_once ("Plateau.php");
	session_start();
	$j1 = new Joueur("wilfi", "red");
	$j2 = new Joueur("pancho", "blue");
	$j3 = new Joueur("deplacement", "white"); // Joueur qui symbolise le tour de jeu où on clique sur une case vide pour effectuer un déplacement
	$j4 = new Joueur("deplacement2", "white"); // Même chose pour le joueur 2

	// Permet de ne pas réinitialiser la partie à chaque fois qu'on appelle la page
 	if(isset($_SESSION['plateau']))
	{
		$monPlateau = $_SESSION['plateau'];
	}
	else 
	{
		$monPlateau = new Plateau($j1, $j2);
		$_SESSION['tourDeJeu'] = $j1;
	}

	// Configuration de la grille
 
	$grille_width  = 5; // largeur de la grille
	$grille_height = 5; // hauteur de la grille
 
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>Entropy</title>
    <style type="text/css" media="screen">
	.grille
	{
		float: left;
	}
    .grille .row {
        margin-left: 5px;
    }
 
    .grille .row:after {
        content: " ";
        display: block;
        height: 0;
        clear: both;
    }
 
    .grille .case 
	{
        display: block;	
        float: left;
        width: 100px;
        height: 100px;
        border: 1px solid #A4A4A4;
        border-top: none;
        border-left: none;
    }
	
	/* A revoir */
	a img
	{
		padding: 0px;
		margin: 0px;
		border: 0px;
		width: 90px;
		height: 90px;
	}
	a
	{	
		background: white;
		border: white;
	}

    </style>
   	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	
    <script type="text/javascript">
	// Début du script JS

    $(function () 
	{
        	$('.case').hover(
            	function () 
				{
                	$(this).css('background', '#eee');
            	},
            	function () 
				{
	                $(this).css('background', <?php echo "'","white","'";?>);
	       	 	}
       	 	);
    });
	
    </script>
</head>
<body>

		<div class="grille">

		<!-- Gestion de la partie avec l'affichage et les tours de jeu pour les 2 joueurs-->

   		<?php for ($i = 0; $i < $grille_width; $i++)
		{?>	
				
       	 		<div class="row">
        		<?php for ($j = 0; $j < $grille_height; $j++)
			{ ?>	
          			<span class="case"> <a href=<?php echo "Jeu.php?coordX=", $j, "&coordY=", $i; ?> >

					<?php
						
							$cases = $monPlateau -> getCellulePlateau($j, $i);
								if($cases -> getCaseJoueur() != null)
								{							
										if($cases -> getCaseJoueur() -> getCouleur() == "blue")
									{
										 echo "<img src=\"panda.jpg\" alt=\"J1\" />";
									}
									if($cases -> getCaseJoueur() -> getCouleur() == "red")
									{
										echo "<img src=\"panda2.jpeg\" alt=\"J2\" />" ;
								
									}
								}
								//else echo "Ceci est du texte. J'aime trooooppp Solenn Maillard :p";
								//else echo "<img src=\"So.png\" alt=\"J2\" />";
							
							// Tour de jeu j1
							
							if($_SESSION['tourDeJeu'] == $j1 or $_SESSION['tourDeJeu'] == $j3)
							{
								if(isset ($_GET['coordX']) and isset($_GET['coordY']))
								{
									$x = $_GET['coordX'];
									$y = $_GET['coordY'];
								
										if ($monPlateau -> getCellulePlateau($x, $y) -> getCaseJoueur() != null)
										{
											if($monPlateau -> getCellulePlateau($x, $y) -> getCaseJoueur() -> getCouleur() == "red")
											{	
												$_SESSION['j1X'] = $x;
												$_SESSION['j1Y'] = $y;
												$_SESSION['tourDeJeu'] = $j3;
												
												foreach($monPlateau -> deplacement($x, $y, $j1) as $caseDep)
												{
													if($cases == $caseDep)
													{
														//echo "test4";
														echo "<img src=\"So.png\" alt=\"casesDéplacement\" />";
													}
											
												}
										
											}
											else {}//echo "blue";
										}
										
									// Vraiment utile le else if ?
									else if (isset($_SESSION['j1X']) and $_SESSION['tourDeJeu'] == $j3)
									{
										$ancienX = $_SESSION['j1X'];
										$ancienY = $_SESSION['j1Y'];
										if($monPlateau -> deplacement($ancienX, $ancienY, $j1) != null)
										{
											foreach($monPlateau -> deplacement($ancienX, $ancienY, $j1) as $caseDep)
											{
												if($cases == $caseDep)
												{
													//echo "test4";
													echo "<img src=\"So.png\" alt=\"casesDéplacement\" />";
												}
												else if ($_GET['coordX'] == $caseDep -> getCoordCaseX() and 
													$_GET['coordY'] == $caseDep -> getCoordCaseY())
												{	
													$caseArrivee = $monPlateau -> getCellulePlateau($_GET['coordX'], $_GET['coordY']);
													$caseArrivee -> setCaseJoueur($j1);
													$monPlateau -> getCellulePlateau($ancienX, $ancienY) -> setCaseJoueur(null);
													$_SESSION['tourDeJeu'] = $j2;
													header('Location: Jeu.php');
													// deplacement du pion càd changement de coordonnées
												}
											}
										}
									}
								}
							}

							// Tour de jeu j2
							else if ($_SESSION['tourDeJeu'] == $j2 or $_SESSION['tourDeJeu'] == $j4)
							{
								if(isset ($_GET['coordX']) and isset($_GET['coordY']))
								{
									$x = $_GET['coordX'];
									$y = $_GET['coordY'];
								
										if ($monPlateau -> getCellulePlateau($x, $y) -> getCaseJoueur() != null)
										{
											if($monPlateau -> getCellulePlateau($x, $y) -> getCaseJoueur() -> getCouleur() == "blue")
											{	
												$_SESSION['j2X'] = $x;
												$_SESSION['j2Y'] = $y;
												$_SESSION['tourDeJeu'] = $j4;
												foreach($monPlateau -> deplacement($x, $y, $j2) as $caseDep)
												{
													if($cases == $caseDep)
													{	
														echo "<img src=\"So.png\" alt=\"casesDéplacement\" />";
													}
												}
											}								
										}
										
									// Vraiment utile le else if ?
									
									else if (isset($_SESSION['j2X']) and $_SESSION['tourDeJeu'] == $j4)
									{
										echo "test2";
										$ancienX = $_SESSION['j2X'];
										$ancienY = $_SESSION['j2Y'];
										if($monPlateau -> deplacement($ancienX, $ancienY, $j2) != null)
										{
											foreach($monPlateau -> deplacement($ancienX, $ancienY, $j2) as $caseDep)
											{
												if($cases == $caseDep)
												{
													echo "<img src=\"So.png\" alt=\"casesDéplacement\" />";
												}
												else if ($_GET['coordX'] == $caseDep -> getCoordCaseX() and 
													$_GET['coordY'] == $caseDep -> getCoordCaseY())
												{	
													$caseArrivee = $monPlateau -> getCellulePlateau($_GET['coordX'], $_GET['coordY']);
													$caseArrivee -> setCaseJoueur($j2);
													$monPlateau -> getCellulePlateau($ancienX, $ancienY) -> setCaseJoueur(null);
													$_SESSION['tourDeJeu'] = $j1;
													header('Location: Jeu.php');
													// deplacement du pion càd changement de coordonnées
												}
											}
										}
									}
								}
							}
							
					?>

			  	</a>  </span>
        	<?php } ?>
				</div>
					<!-- Fin de la gestion de la partie avec l'affichage et les tours de jeu pour les 2 joueurs-->
	<?php } ?>	
	
        
    	</div>

		<!-- Bouton pour recommencer une partie-->
		<div style="float: right;">
			<form method = "get" action="Reinitialisation.php">
				<input type="submit" name="reini" value= "Redémarer la partie" />
			</form>
		</div>
	
</body>
	
</html>

<?php 
	// Sauvegarde de l'état du plateau
	$_SESSION['plateau'] = $monPlateau;
?>
	


