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
 
    .grille .case {
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
    </style>
    <!--
    //<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	//	Chargement de la librairie javascript jquery
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
	                $(this).css('background', 'white');
	        }
        );
    });
	
    </script>
	-->
</head>
<body>
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
