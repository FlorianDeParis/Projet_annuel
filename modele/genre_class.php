<?php

class Genre
{
  		private $id;
  		private $libele_genre;
 			
 		private $req;
 		private $user;
		private $genre_souhaite;
  		
		/**
		 * @author AdrienSy
		 * @param unknown_type $id
		 */
		public function __construct($id = false)
		{
			if ($id)
			{
				$this->getById($id);
			}
		}
		
		/**
		 * @author AdrienSy
		 * @param unknown_type $aGenreSql
		 */
		public function hydrateFromSql($aGenreSql)
		{
			$this->id = $aGenreSql['ID_GENRE_USE'];
			$this->libele_genre = $aGenreSql['LIBEL_GENRE_USE'];
		}
		
		/**
		 * @author AdrienSy
		 * @param unknown_type $id
		 */
		public function getById($id)
		{
			$result = Connexion::select(sprintf("SELECT * FROM genre_use WHERE ID_GENRE_USE = %d",$id));
				
			if (!empty($result))
			{
				$result = $result[0];
				
				$this->id = $result['ID_GENRE_USE'];
				$this->libele_genre = $result['LIBEL_GENRE_USE'];
				
				return $this;
			}
			else
			{
				return null;
			}
		}
		
		//include 'connexion_class.php';
		
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
		
		//Tache a faire

			//fonction qui retourne le formulaire des status, ajout, suppression, modificaction, liste
			// on decoupe en sous fonction les 4 etapes
			//fonction boolean qui retourne le status
 	
 		//Fonction de vérification des statuts
 		public function verif_genre($genre_souhaite){
 			$req = "SELECT libel_genre_use FROM genre_use WHERE libel_genre_use = $genre_souhaite";
 			if($req){
 				echo "le statut \"$genre_souhaite\" existe dans la base de données";
 			}
 			else{
 				echo "le statut \"$genre_souhaite\" n'existe pas dans la base de données";
 			}
 		}

 		// Ajout d'un statut
 		public function ajout_statut($genre_souhaite){
 			$req = "INSERT INTO genre_use(libel_genre_use) VALUES ($genre_souhaite)";
 			$resultat = pdo_sql_objet($req);
 			return $resultat;
 			
 		}
 		
		// Suppression d'un statut
 		public function supp_statut($genre_souhaite){		
 			$req ="DROP libel_genre_use FROM genre_use WHERE libel_genre_use = $genre_souhaite";
 			$resultat = pdo_sql_objet($req);
 			return $resultat;
 		}
 		
		// Fonction qui genere la liste des statut
 		public function select_status(){
   
 			$reponse = mysql_query("SELECT * FROM genre_use"); // Requête SQL
 			// On fait une boucle pour lister tout ce que contient la table :
			echo "<select name='libel_genre_use'>";
 			while ($donnees = mysql_fetch_array($reponse) ) {
 				echo "<option value='".$donnees['Champ0']."'>'".$donnees['Champ0']."'</option>";
 				echo $donnees['Champ0'];
 			}
 			echo "</select>";
		}
		
		
		
  	/////////////////////////// Accesseur ////////////////////////////
  	////////// GET //////////
  	public function getId()
  	{
  		return $this->id;
  	}
  		public function getLibele_genre(){
  			return $this->libele_genre;
  		}

	////////// SET //////////
  		public function setLibele_genre($newLibele_genre){
  			if(is_int($libele_genre) == true){
  				$this->libele_genre = $newLibele_genre;
  			}
  		}
  		
  		public function setId($id)
  		{
  			$this->id = $id;
  		}
}
