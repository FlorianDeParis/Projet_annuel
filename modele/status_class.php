<?php

	class Status
	{
		private $id_sta;
		private $libele_sta;
		
	//Tache a faire
        //fonction qui retourne le formulaire des status, ajout, suppression, modifiaction, liste
        // on decoupe en sous fonction les 4 etapes
        //fonction boolean qui retourne le status
		
        
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
        
		public function getLibele_sta(){
			return $this->libele_sta;
		}

		public function setLibele_sta($newLibele_sta){
			if(is_int($libele_sta) == true){
				$this->libele_sta = $newLibele_sta;
			}
		}	
	}
