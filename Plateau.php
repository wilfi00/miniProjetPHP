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

			// Initialisation partie (pions placés pour commencer une partie)
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
		
		// retourne la case à l'emplacement $x $y du plateau
		public function getCellulePlateau($x, $y)
		{
			return $this -> cellulesPlateau[$x][$y];
		}

		// retourne le plateau
		public function getPlateau()
		{
			return $this -> cellulesPlateau;
		}

		// retourne la couleur de la case à l'emplacement $x $y du plateau
		public function couleurCase($x, $y)
		{
			return $this -> cellulesPlateau[$x][$y] -> getCaseJoueur() -> getCouleur();
		}

		// retourne vrai si la case à l'emplacement $x $y du plateau est vide
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

		// Fonction qui retourne un tableau de Cases (classe Casse)
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
			if(!isset($deplacement)) $deplacement = null;
			return $deplacement;
		}

		public function gagnee($j)
		{
			$nbPions = 0;

			for($x = 0; $x <= 4; $x++)
			{
				for($y = 0; $y <= 4; $y++)
				{
					$joueur = $this -> getCellulePlateau($x, $y) -> getCaseJoueur();
					

					// Si le pion est à lui
					if($joueur == $j)
					{
						$casesAdj = $this -> getCasesAdjacentes($x, $y);

						// Si aucun pion n'est isolé
						if($casesAdj != null)
						{
							foreach($casesAdj as $cases)
							{	
								$joueurAutre = $cases -> getCaseJoueur();
								if($joueurAutre != $j)
								{
									$nbPions++;
								}
							}
							/*
							for($x = 0; $x <= 4; $x++)
							{
								for($y = 0; $y <= 4; $y++)
								{
									$joueur2 =  $casesAdj[$x][$y] -> getCaseJoueur();
								}
							}*/
							// Si aucun de ses pions sont adjacents
							
						}
					}
				}
			}
			// Si les 7 pions respectent la condition le joueur a gagné
			echo $nbPions;
			if($nbPions == 7) return true;
			else return false;
		}	

		
	}

?>


