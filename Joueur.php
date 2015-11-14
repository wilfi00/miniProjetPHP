<?php

// Classe qui définie un joueur par son pseudo et sa couleur
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

	public function setPseudo ($j)
	{
		echo $j;
		$this -> pseudo = $j;
	}

}

?>
