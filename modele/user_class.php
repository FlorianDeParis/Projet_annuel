<?php
	class User
	{
		private $id;
		private $nom;
		private $prenom;
		private $email;
		private $pseudo;
		private $password;
		private $date_new;
		private $date_modif;
		private $etat;
		private $valideCgu;
		private $oGenre;
	
		
		public function __construct($id = false)
		{
			if ($id)
			{
				$this->getById($id);
			}
		}
		
		public function hydrateFromSql($result)
		{
			$this->id = $result['ID_USE'];
			$this->nom = $result['NOM_USE'];
			$this->prenom = $result['PRENOM_USE'];
			$this->email = $result['EMAIL_USE'];
			$this->pseudo = $result['PSEUDO_USE'];
			$this->password = $result['PASSWORD_USE'];
			$this->date_new = $result['DATE_NEW_USE'];
			$this->date_modif = $result['DATE_MODIF_USE'];
			$this->etat = $result['ETAT_USE'];
			$this->valideCgu = $result['VALIDE_CGU_USE'];
			
			$this->oGenre = Genres::getGenre($result['ID_GENRE_USE']);
		}
		
		public function getById($id)
		{
			$result = Connexion::select(sprintf("SELECT * FROM utilisateur WHERE ID_USE = %d",$id));
			
			if (!empty($result))
			{
				$result = $result[0];
				
				$this->id = $result['ID_USE'];
				$this->nom = $result['NOM_USE'];
				$this->prenom = $result['PRENOM_USE'];
				$this->email = $result['EMAIL_USE'];
				$this->pseudo = $result['PSEUDO_USE'];
				$this->password = $result['PASSWORD_USE'];
				$this->date_new = $result['DATE_NEW_USE'];
				$this->date_modif = $result['DATE_MODIF_USE'];
				$this->etat = $result['ETAT_USE'];
				$this->valideCgu = $result['VALIDE_CGU_USE'];
				
				$this->oGenre = Genres::getGenre($result['ID_GENRE_USE']);
				
				return $this;
			}
			else
			{
				return null;
			}
		}
		
		/**
		 * Effectue la sauvegarde (INSERT ou UPDATE) en BDD
		 */
		public function save()
		{
			if (!empty($this->id))
			{
				return $this->update();
			}
			else
			{
				return $this->insert();
			}
		}
		
		public function delete()
		{
			return Connexion::delete(sprintf("DELETE FROM utilisateurs WHERE ID_USE = %d", $this->id));
		}
		
		private function insert()
		{
			return Connexion::insert(
					sprintf(
							"INSERT INTO utilisateur(
							ID_GENRE_USE,
							NOM_USE,
							PRENOM_USE,
							EMAIL_USE,
							PSEUDO_USE,
							PASSWORD_USE,
							DATE_NEW_USE,
							DATE_MODIF_USE,
							ETAT_USE,
							VALIDE_CGU_USE
					)
							VALUES(
							%d,
							\"%s\",
							\"%s\",
							\"%s\",
							\"%s\",
							\"%s\",
							\"%s\",
							\"%s\",
							%d,
							%d
					)", $this->oGenre->getId(), $this->nom, $this->prenom, $this->email, $this->pseudo, $this->password, $this->date_new,
						$this->date_modif, $this->etat, $this->valideCgu
					)
			);
		}
		
		private function update()
		{
			return Connexion::insert(
					sprintf(
							"UPDATE utilisateur SET
							ID_GENRE_USE = %d,
							NOM_USE = \"%s\",
							PRENOM_USE = \"%s\",
							EMAIL_USE = \"%s\",
							PSEUDO_USE = \"%s\",
							PASSWORD_USE = \"%s\",
							DATE_NEW_USE = \"%s\",
							DATE_MODIF_USE = \"%s\",
							ETAT_USE = %d,
							VALIDE_CGU_USE = %d
							WHERE ID_USE = %d",
							$this->oGenre->getId(), $this->nom, $this->prenom, $this->email, $this->pseudo, $this->password, $this->date_new,
							$this->date_modif, $this->etat, $this->valideCgu, $this->id
					)
			);
		}
		
		
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
        public function getId(){
        	return $this->id;
        }
		public function getNom(){
			return $this->nom;
		}
		public function getPrenom(){
			return $this->prenom;
		}
		public function getDateNew(){
			return $this->date_new;
		}
		public function getDateModif(){
			return $this->date_modif;
		}
		public function getEtat(){
			return $this->etat;
		}
		public function getEmail(){
			return $this->email;
		}
		public function getPseudo(){
			return $this->pseudo;
		}
		public function getPassword(){
			return $this->password;
		}
		public function getGenreObject()
		{
			return $this->oGenre;
		}
		
		public function getGenreId()
		{
			if (!is_null($this->oGenre) && $this->oGenre->getId())
			{
				return $this->oGenre->getId();
			}
			
			return false;
		}
		
	////////// SET //////////
		public function setNom($nom){
			if(is_string($nom) == true){ 
				$this->nom = $nom; 
			}
		}
		public function setPrenom($prenom){
			if(is_string($prenom) == true){ 
				$this->prenom = $prenom; 
			}
		}
		public function setDateNew($newDateNew){
			$this->date_new = $newDateNew;
			// test à faire pour la variable de type date
		}
		public function setDateModif($newDateModif){
			$this->date_modif = $newDateModif;
			// test à faire pour la variable de type date
		}
		public function setEtat($etat){
			if(is_int($etat) == true){
				$this->etat = $etat;
			}
		}
		public function setEmail($email){
			if(is_string($email) == true){
				$this->email = $email;
			}
		}
		public function setPseudo($pseudo){
			if(is_string($pseudo) == true){
				$this->pseudo = $pseudo;
			}
		}
		public function setPassword($password){
			if(is_string($password) == true){
				$this->password = $password;
			}
		}

		public function setGenre(Genre $oGenre)
		{
			$this->oGenre = $oGenre;
		}
	}

	