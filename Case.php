<?php
	// Erreur si on met Case ???
	class Casse
	{
		private $caseJoueur; // indique le joueur qui a son pion sur la case (null si vide)
		private $coordCaseX; // coordonnée de la case en X (0 >= $coordCaseX >= 4)
		private $coordCaseY; // coordonnée de la case en Y (0 >= $coordCaseY >= 4)

		// Constructeur
		public function __construct ($x, $y)
		{
			$this -> coordCaseX = $x;
			$this -> coordCaseY = $y;
		}
	
		public function getCoordCaseX()
		{
			return $this -> coordCaseX;
		}
	
		public function getCoordCaseY()
		{ 
			return $this -> coordCaseY;
		}

		public function setCoordCase($x, $y)
		{
			$this -> coordCaseX = $x;
			$this -> coordCaseY = $y;
		}
		
		public function getCaseJoueur() 
		{
			return $this -> caseJoueur;
		}

		public function setCaseJoueur($j)
		{
			$this -> caseJoueur = $j;
		}

	}

?>
