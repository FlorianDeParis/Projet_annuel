<?php

class Boite
{
	private $id_boite;
	private $titre_boite;
	private $contenu_boite;
	private $date_ajout_boite;
	private $date_modif_boite;
	private $etat_boite;
	
    //Tache a faire
    //fonction qui affiche un formulaire de saisie de nouvelle id�e
    //fonction qui verifie si il y a de nouvelles id�e
    // fonction boolean qui renvoi le status des id�e
    // fonction poiur valider les nouvelles id�e
    // fonction qui renvoi un formulaire pour changer le status des nouvelles id�e
    // fonction qui liste les nouvelles id�es
    
    ////////////////////////// Fonction ///////////////////////////

    
    
// Fonction d'hydratation =>   Format Donn�es attendu
//    $donnees = array(
//                     3  'id' => 16,
//                     4  'nom' => 'Vyk12',
//                     5  'forcePerso' => 5,
//                     6  'degats' => 55,
//                     7  'niveau' => 4,
//                     8  'experience' => 20
//                     9);
    
    public function hydrate(array $donnees){
        foreach ($donnees as $key => $value){
            // On r�cup�re le nom du setter correspondant � l'attribut.
            $method = 'set'.ucfirst($key);
        
            // Si le setter correspondant existe.
            if (method_exists($this, $method)){
              // On appelle le setter.
              $this->$method($value);
            }
        }
    }
    
    
    
    /////////////////////////// Accesseur ////////////////////////////
	////////// GET //////////
    public function getId_boite() {
		return $this->id_boite;
	}
	
	public function getTitre_boite() {
		return $this->titre_boite;
	}
	
	public function getContenu_boite() {
		return $this->contenu_boite;
	}
	
	public function getDate_ajout_boite() {
		return $this->date_ajout_boite;
	}
	
    public function getDate_modif_boite() {
		return $this->date_modif_boite;
	}
	
	public function getEtat_boite() {
		return $this->etat_boite;
	}
    
    ////////// SET //////////
	public function setId_boite($id_boite) {
		$this->id_boite = $id_boite;
	}
	
	public function setTitre_boite($titre_boite) {
		$this->titre_boite = $titre_boite;
	}
	
	
	public function setContenu_boite($contenu_boite) {
		$this->contenu_boite = $contenu_boite;
	}
	
	public function setDate_ajout_boite($date_ajout_boite) {
		$this->date_ajout_boite = $date_ajout_boite;
	}

	public function setDate_modif_boite($date_modif_boite) {
		$this->date_modif_boite = $date_modif_boite;
	}

	public function setEtat_boite($etat_boite) {
		$this->etat_boite = $etat_boite;
	}
	
}

?>