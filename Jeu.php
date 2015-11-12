<?php
	//echo "'","red","'";
	//echo "'",$couleur_case,"'";
	require_once ("Plateau.php");
	$couleur_case = "white";
	$j1 = new Joueur("wilfi", "red");
	$j2 = new Joueur("pancho", "blue");
 	$monPlateau = new Plateau($j1, $j2);
	//echo $monPlateau -> couleurCase(4, 4);
	//var_dump($monPlateau);
	//var_dump($monPlateau -> deplacementPossibleCases(0, 0));
	//var_dump($monPlateau -> getCasesAdjacentes(4, 4));
	//var_dump($monPlateau -> deplacement(0, 3, $j2));
?>

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
        margin-left: 4px;
        margin-bottom: 4px;
        width: 100px;
        height: 100px;
        border: 1px solid #ddd;
        border-top: none;
        border-left: none;
    }

	/* A revoir */
	button img
	{
		width: 70px;
		height: 70px;
	}
	button
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
	 <button onclick="ClicBouton();"> <img src="panda.jpg" alt="J1" /> </button> 
	<div class="grille">
	
   	<?php for ($i = 0; $i < $grille_width; $i++)
	{?>	
				
        	<div class="row">
        	<?php for ($j = 0; $j < $grille_height; $j++)
		{ ?>	
          		<span class="case"></span>
        	<?php } ?>
		</div>
	<?php } ?>	
	
        
    </div>
</body>
</html>
