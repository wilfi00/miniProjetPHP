<?php

//Obvious classe
class Joueur
{
    private $pseudo;
	private $couleur;

    public function __construct($pseudo, $couleur)
    {
        $this -> pseudo = $pseudo;
		$this -> couleur = $couleur;
	}

    public function getPrenom()
    {
		return $this -> pseudo;
	}

	public function getCouleur()
	{
		return $this -> couleur;
	}

}

?>
