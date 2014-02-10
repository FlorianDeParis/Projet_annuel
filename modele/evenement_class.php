<?php

	class Evenement
	{
		private $id;
		private $id_news;
		private $libelle;
		private $date;
		
	//tache a faire
        //fonction qui liste un calendrier avec les evenement
        //fonction qui liste un calendrier avec les evenement d'une personne en particulier
        //fonction qui previent l'utilisateur qu'un evenement dont il a souscrit est proche
        //fonction qui permet la saisie d'un nouvelle evenement avec formulaire
        //fonction qui permet la saisie d'un nouvelle evenement avec juste des paramettres
        //fonction qui renvoi le status d'un evenement
        //fonction qui test si un evenement est d'actualité ou dépasser 
        
		
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
		public function getId()
		{
			return $this->id;
		}
		
		public function getIdNews()
		{
			return $this->id_news;
		}
		
		public function getLibelle()
		{
			return $this->libelle;
		}
		
		public function getDate()
		{
			return $this->date;
		}
		
		////////// SET //////////
		public function setLibelle($libelle)
		{
			if(is_string($libelle) == true)
			{
				$this->libelle = $libelle;
			}
		}
		
		public function setDate($date)
		{
			$this->date = $date;
		}
		
		public function setIdNews($id_news)
		{
			$this->id_news = $id_news;
		}
	}
