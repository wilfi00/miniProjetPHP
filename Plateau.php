<?php
	require_once ("Case.php");
	require_once ("Joueur.php");
	class Plateau
	{

		// http://www.apprendre-php.com/tutoriels/tutoriel-7-les-tableaux-ou-arrays.html
		// https://secure.php.net/manual/fr/ref.array.php
		private $cellulesPlateau = array();
	
		// On a en paramètre le Joueur1 et le Joueur2 pour initialiser le plateau
		function __construct($Joueur1, $Joueur2)
		{
			// Construction du plateau 5*5
			for ($i = 0; $i <= 4; $i++)
			{
				$this -> cellulesPlateau[$i] = array();
	
				for ($j = 0; $j <= 4; $j++)	
				{			
					$this -> cellulesPlateau[$i][$j] = new Casse($i, $j);
					
					//$cellulesPlateau[$i][$j] = 1;
				}

			}

			// Initialisation partie (pions placés)
			for ($i = 0; $i <= 4; $i++)
			{
				$this -> cellulesPlateau[$i][0] -> setCaseJoueur($Joueur1);
				$this -> cellulesPlateau[$i][4] -> setCaseJoueur($Joueur2);
			}

			$this -> cellulesPlateau[0][1] -> setCaseJoueur($Joueur1);
			$this -> cellulesPlateau[4][1] -> setCaseJoueur($Joueur1);
			$this -> cellulesPlateau[0][3] -> setCaseJoueur($Joueur2);
			$this -> cellulesPlateau[4][3] -> setCaseJoueur($Joueur2);
		}

		public function getCellulePlateau($x, $y)
		{
			return $this -> cellulesPlateau[$x][$y];
		}

		public function couleurCase($x, $y)
		{
			return $this -> cellulesPlateau[$x][$y] -> getCaseJoueur() -> getCouleur();
		}

		public function caseVide($x, $y)
		{
			if ($this -> cellulesPlateau[$x][$y] -> getCaseJoueur() == null)
			{
				return true;
			}
			else
			{
				return false;
			}
		}

		// fonction qui retourne un tableau de Cases (classe Casse)
		// Retourne toutes les cases adjacentes à une case de coordonnées x $x et y $y 
		public function getCasesAdjacentes($x, $y)
		{
			$casesAdjacentes = array(array());
			if (($x + 1) <= 4)
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x+1, $y);
			}
			if ((($x + 1) <= 4) && (($y + 1) <= 4))
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x+1, $y+1);
			}
			if (($y + 1) <= 4)
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x, $y+1);
			}
			if (($x - 1) >= 0)
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x-1, $y);
			}
			if ((($x - 1) >= 0) && (($y - 1) >= 0))
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x-1, $y-1);
			}
			if (($y - 1) >= 0)
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x, $y-1);
			}
			if ((($x + 1) <= 4) && (($y - 1) >= 0))
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x+1, $y-1);
			}
			if ((($x - 1) >= 0) && (($y + 1) <= 4))
			{
				$caseAdjacentes[] = $this -> getCellulePlateau($x-1, $y+1);
			}
	
			return $caseAdjacentes;

		}
		
		// fonction qui retourne un tableau de Cases (classe Casse)
		// Retourne toutes les cases adjacentes à une case de coordonnées x $x et y $y vides
		public function deplacementPossibleCases($x, $y)
		{
			// Cases adjacentes *à la case* mais un pion dessus
			$caseAdjacentes = $this -> getCasesAdjacentes($x, $y);
			foreach($caseAdjacentes as $cases)
			{
				if($this -> caseVide($cases -> getCoordCaseX(), $cases -> getCoordCaseY()))
				{
					$casesPossibles[] = $cases;
				}

			}
			return $casesPossibles;
		}

		// Fonction qui retourne un tableau de Cases (classe Casse)
		// Retourne toutes les cases où un pion de coordonnées x $x et y $y peut se déplacer
		public function deplacement($x, $y, $j)
		{
			$depPossible = false;
			$casesAdjacentes = $this -> getCasesAdjacentes($x, $y);
			foreach($casesAdjacentes as $cases)
			{	
				if($cases -> getCaseJoueur() == $j) $depPossible = true;
			}
			if($depPossible)
			{
				$depX = 1;
				$depY = 1;

				// Déplacement horizontal à droite
				while($x + $depX < 5 and $this -> caseVide($x + $depX, $y))
				{
					$deplacement[] = new Casse($x + $depX, $y);
					$depX++;
				}
				$depX = 1;


				// Déplacement diagonal en bas à droite
				while($x + $depX < 5 and $y + $depY < 5 and $this -> caseVide($x + $depX, $y + $depY))
				{
					$deplacement[] = new Casse($x + $depX, $y + $depY);
					$depX++;
					$depY++;
				}
				$depX = 1;
				$depY = 1;

				// Déplacement vertical en bas
				while($y + $depY < 5 and $this -> caseVide($x, $y + $depY))
				{
					$deplacement[] = new Casse($x, $y + $depY);
					$depY++;
				}
				$depY = 1;


				// Déplacement diagonal en bas à gauche
				while($x - $depX >= 0 and $y + $depY < 5 and $this -> caseVide($x - $depX, $y + $depY))
				{
					$deplacement[] = new Casse($x - $depX, $y + $depY);
					$depX++;
					$depY++;
				}
				$depX = 1;
				$depY = 1;

				// Déplacement horizontal à gauche
				while($x - $depX >= 0 and $this -> caseVide($x - $depX, $y))
				{
					$deplacement[] = new Casse($x - $depX, $y);
					$depX++;
				}
				$depX = 1;

				// Déplacement diagonal en haut à gauche
				while($x - $depX >= 0 and $y - $depY >= 0 and $this -> caseVide($x - $depX, $y - $depY))
				{
					$deplacement[] = new Casse($x - $depX, $y - $depY);
					$depX++;
					$depY++;
				}
				$depX = 1;
				$depY = 1;

				// Déplacement vertical en haut
				while($y - $depY >= 0 and $this -> caseVide($x, $y - $depY))
				{
					$deplacement[] = new Casse($x, $y - $depY);
					$depY++;
				}
				$depY = 1;

				// Déplacement diagonal en haut à droite
				while($x + $depX < 5 and $y - $depY >= 0 and $this -> caseVide($x + $depX, $y - $depY))
				{
					$deplacement[] = new Casse($x + $depX, $y - $depY);
					$depX++;
					$depY++;
				}
				$depX = 1;
				$depY = 1;
			}
			else $deplacement = null;
			return $deplacement;
		}

		// Il faut gerer les clics souris
		// Sur une image ?
	}

?>


