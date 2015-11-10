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

		public function getCasesAdjacentes($x, $y)
		{
			$casesAdjacentes = array(array());
			if (($x + 1) <= 4)
			{
				$cases = array($x+1, $y);
				//array_push($caseAdjacentes, $cases);
				$caseAdjacentes[] = $cases;
			}
			if ((($x + 1) <= 4) && (($y + 1) <= 4))
			{
				$cases = array($x+1, $y+1);
				$caseAdjacentes[] = $cases;
				//array_push($caseAdjacentes, $cases);
			}
			if (($y + 1) <= 4)
			{
				$cases = array($x, $y+1);
				$caseAdjacentes[] = $cases;
				//array_push($caseAdjacentes, $cases);
			}
			if (($x - 1) >= 0)
			{
				$cases = array($x+1, $y);
				$caseAdjacentes[] = $cases;
				//array_push($caseAdjacentes, $cases);
			}
			if ((($x - 1) >= 0) && (($y - 1) >= 0))
			{
				$cases = array($x+1, $y-1);
				$caseAdjacentes[] = $cases;
				//array_push($caseAdjacentes, $cases);
			}
			if (($y - 1) >= 0)
			{
				$cases = array($x, $y-1);
				$caseAdjacentes[] = $cases;
				//array_push($caseAdjacentes, $cases);
			}
			if ((($x + 1) >= 0) && (($y - 1) >= 0))
			{
				$cases = array($x+1, $y-1);
				$caseAdjacentes[] = $cases;
			}
			if ((($x - 1) >= 0) && (($y + 1) >= 0))
			{
				$cases = array($x-1, $y+1);
				$caseAdjacentes[] = $cases;
			}
	
			return $caseAdjacentes;

		}

		public function deplacementImpossible($x, $y)
		{
			// Cases adjacentes *à la case* mais un pion dessus
		}

		public function deplacementPossible($x, $y)
		{
			// Cases adjacentes *à la case* et pas de pion dessus
		}

		// Il faut gerer les clics souris
		// 
	}

?>


