<?php
	require_once ("Plateau.php");
	session_start();
	$couleur_case = "white";
	$j1 = new Joueur("wilfi", "red");
	$j2 = new Joueur("pancho", "blue");
	$j3 = new Joueur("deplacement", "white"); // Joueur qui symbolise le tour de jeu où on clique sur une case vide pour effectuer un déplacement
	$pionJ1 = false;
	
	if(isset($monPlateau)) $_SESSION['plateau'] = $monPlateau;
 	if(isset($_SESSION['plateau']))
	{
		$monPlateau = $_SESSION['plateau'];
	}
	else 
	{
		$monPlateau = new Plateau($j1, $j2);
		$_SESSION['tourDeJeu'] = $j1;
	}

	//var_dump($_SESSION['plateau']);
	//echo $monPlateau -> couleurCase(4, 4);

	//var_dump($monPlateau -> deplacementPossibleCases(0, 0));
	//var_dump($monPlateau -> getCasesAdjacentes(4, 4));
	//var_dump($monPlateau -> deplacement(0, 3, $j2));	




	//var_dump($monPlateau);
		
?>
<?php
		//echo $monPlateau -> getCellulePlateau(0,0) -> getCoordCaseY();
		
	?>
	<?php 	$j1 -> setPseudo("bite");	?>
<?php
 	
	// Configuration de la grille
 
	$grille_width  = 5; // largeur de la grille
	$grille_height = 5; // hauteur de la grille
 
?>
<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>Grille</title>
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
        /* visibility: hidden; */
        display: block;
        height: 0;
        clear: both;
    }
 
    .grille .case 
	{
		/*background: <?php echo $couleur_case;?>;	*/
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
	                $(this).css('background', <?php echo "'",$couleur_case,"'";?>);
	       	 	}
       	 	);
    });
	
    </script>
</head>
<body>

		<div class="grille">
	
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
										if($monPlateau -> deplacement($ancienX, $ancienY, $j1 != null))
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
													// deplacement du pion càd changement de coordonnées
												}
											}
										}
									}
								}
							}
							else if ($_SESSION['tourDeJeu'] == $j2)
							{
	
							}
							
					?>

			  	</a>  </span>
        	<?php } ?>
				</div>
	<?php } ?>	
	
        
    	</div>

		<div style="float: right;">
			<form method = "get" action="Reinitialisation.php">
				<input type="submit" name="reini" value= "Redémarer la partie" />
			</form>
		</div>
	
</body>
	
</html>
<?php 
	//var_dump($_SESSION['plateau']);
	$_SESSION['plateau'] = $monPlateau; 
	if(!isset($_SESSION['j1X'])) echo "pas def";

?>
	


