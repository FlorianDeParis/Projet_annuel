<?php

	class Commentaire{
		private $id_comm;
		private $comm;
		private $date_ajout_comm;
		private $date_modif_comm;
		private $etat_comm;	
		
		public function __construct(){
		
		}
		//Tache a faire
        //fonction qui affiche les commentaire
        //fonction qui affiche un textarea pour la saisie d'un commentaire
        //fonction qui retourne le fameux element de mise en forme du texte
        //fonction qui nous envoi un avertissment pour les chaque nouveaux commentaires
        //fonction qui permet de valider un commetaire
        //fonction qui renvoi le status d'un commentaire
		
        
        // Fonction d'hydratation =>   Format Données attendu
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
                // On récupère le nom du setter correspondant à l'attribut.
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
		public function getComm(){
			return $this->comm;
		}
		public function getDateAjout_comm(){
			return $this->date_ajout_comm;
		}
		public function getDateModif_comm(){
			return $this->date_modif_comm;
		}
		public function getEtat_comm(){
			return $this->etat_comm;
		}
		
		
		
		
			////////// SET //////////
		public function setComm($newComm){
			if(is_string($comm) == true){
				$this->comm = $newComm;
				}
		}
		public function setDateAjout_comm($newDateAjout_comm){
			$this->date_ajout_comm = $newDateAjout_comm;
			// test à faire pour la variable de type date
		}
		public function setDateModif_comm($newDateModif_comm){
			$this->date_modif_comm = $newDateModif_comm;
			// test à faire pour la variable de type date
		}
		public function setEtat_comm($newEtat_comm){
			if(is_int($etat_comm) == true){
				$this->etat_comm = $newEtat_comm;
			}
		}
		
		

			
	}

?>