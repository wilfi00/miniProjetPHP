<?php
	session_start();
	require_once ("Plateau.php");
	$couleur_case = "white";
	$j1 = new Joueur("wilfi", "red");
	$j2 = new Joueur("pancho", "blue");
	$_SESSION['plateau'] = $monPlateau;
 	if($_SESSION['plateau'] != null)
	{
		echo "existe";	
		$monPlateau = $_SESSION['plateau'];
	}
	else 
	{
		$monPlateau = new Plateau($j1, $j2);

	}
	var_dump($_SESSION['plateau']);
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
		font: white;
		padding: 0px;
		margin: 0px;
		border: 0px;
		width: 90px;
		height: 90px;
	}
	a
	{	
		color: white;
		background: white;
		border: white;
	}

	p
	{
		background: blue;
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
								else echo "Ceci est du texte. J'aime trooooppp Solenn Maillard :p";
							
					?>

			  	</a>  </span>
        	<?php } ?>
				</div>
	<?php } ?>	
	
        
    	</div>
	
</body>
	
</html>
<?php $_SESSION['plateau'] = $monPlateau; ?>



