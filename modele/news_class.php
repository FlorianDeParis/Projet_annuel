<?php
	class News
	{
		private $id = false;
		/**
		 * La catégorie
		 * @var Catégorie
		 */
		private $oCategorie=null;
		/**
		 * Utilisateur lié
		 * @var unknown_type
		 */
		private $oUser=null;
		private $titre = "";
		private $contenuLong = "";
		private $contenuCourt = "";
		private $dateAjout = "";
		private $dateModification = "";
		private $etat = 1;
		private $dossierImage = "";
		private $dossierNews = "";
		
		public function __construct($id = false)
		{
			if ($id)
			{
				$this->getById($id);
			}
		}
		
		
		/**
		 * @param array $aNewsSql
		 */
		public function hydrateFromSql($aNewsSql)
		{
			$this->id = $aNewsSql['ID_NEWS'];
			$this->titre = $aNewsSql['TITRE_NEWS'];
			$this->contenuLong = $aNewsSql['CONTENU_LONG_NEWS'];
			$this->contenuCourt = $aNewsSql['CONTENU_COUT_NEWS'];
			$this->dateAjout = $aNewsSql['DATE_AJOUT_NEWS'];
			$this->dateModification = $aNewsSql['DATE_MODIF_NEWS'];
			$this->etat = $aNewsSql['ETAT_NEWS'];
			$this->dossierImage = $aNewsSql['DOSSIER_IMAGE'];
			$this->dossierNews = $aNewsSql['DOSSIER_NEWS'];
			
			$this->oCategorie = new Categorie($aNewsSql['ID_CAT']);
			$this->oUser = new User($aNewsSql['ID_USE']);
		}
		
		public function setFromPost($aPost)
		{
			$this->titre = $aPost['titre'];
			$this->contenuLong = $aPost['contenu'];
			
			$this->oCategorie = new Categorie($aPost["id_categorie"]);
			$this->oUser = new User($aPost["id_user"]);
		}
		
        public function getById($id)
		{
			$result = Connexion::select(sprintf("SELECT * FROM news WHERE ID_NEWS = %d",$id));
			
			if (!empty($result))
			{
				$result = $result[0];
				
				$this->id = $result['ID_NEWS'];
				$this->contenuCourt = $result['CONTENU_COUT_NEWS'];
				$this->contenuLong = $result['CONTENU_LONG_NEWS'];
				$this->dateAjout = $result['DATE_AJOUT_NEWS'];
				$this->dateModification = $result['DATE_MODIF_NEWS'];
				$this->dossierImage = $result['DOSSIER_IMAGE'];
				$this->dossierNews = $result['DOSSIER_NEWS'];
				$this->etat = $result['ETAT_NEWS'];
				$this->titre = $result['TITRE_NEWS'];
					
				$this->oCategorie = new Categorie($result['ID_CAT']);
				$this->oUser = new User($result['ID_USE']);
				
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
			return Connexion::delete(sprintf("DELETE FROM news WHERE ID_NEWS = %d", $this->id));
		}
		
		public function isOk()
		{
			return $this->etat;
		}
		
		private function insert()
		{
			return Connexion::insert(
					sprintf(
							"INSERT INTO news(
								ID_CAT,
								ID_USE,
								TITRE_NEWS,
								CONTENU_LONG_NEWS,
								CONTENU_COUT_NEWS,
								DATE_AJOUT_NEWS,
								DATE_MODIF_NEWS,
								ETAT_NEWS,
								DOSSIER_IMAGE,
								DOSSIER_NEWS
							) 
							VALUES(
								%d,
								%d,
								\"%s\",
								\"%s\",
								\"%s\",
								\"%s\",
								\"%s\",
								%d,
								\"%s\",
								\"%s\"
							)", $this->oCategorie->getId(), $this->oUser->getId(), $this->titre, $this->contenuLong, $this->contenuCourt, date("Y/m/d H:i:s"),
								date("Y/m/d H:i:s"), $this->etat, $this->dossierImage, $this->dossierNews
						)
				);
		}
		
		private function update()
		{
			return Connexion::update(
					sprintf(
						"UPDATE news SET
						ID_CAT = %d,
						ID_USE = %d,
						TITRE_NEWS = \"%s\",
						CONTENU_LONG_NEWS = \"%s\",
						CONTENU_COUT_NEWS = \"%s\",
						DATE_MODIF_NEWS = \"%s\",
						ETAT_NEWS = %d,
						DOSSIER_IMAGE = \"%s\",
						DOSSIER_NEWS = \"%s\"",
						$this->oCategorie->getId(), $this->oUser->getId(), $this->titre, $this->contenuLong, $this->contenuCourt,
						date("Y/m/d H:i:s"), $this->etat, $this->dossierImage, $this->dossierNews
					)
			);
		}
		
        // Fonction d'hydratation =>   Format DonnÃ©es attendu
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
                // On rÃ©cupÃ¨re le nom du setter correspondant Ã  l'attribut.
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
		public function getTitre(){
			return $this->titre;
		}
		public function getContenuLong(){
			return $this->contenuLong;
		}
		public function getContenuCourt(){
			return $this->contenuCourt;
		}
		public function getDateAjout(){
			return $this->dateAjout;
		}
		public function getDateModification(){
			return $this->dateModification;
		}
		public function getEtat(){
			return $this->etat;
		}
		public function getDossierImage(){
			return $this->dossierImage;
		}
		public function getDossierNews(){
			return $this->dossierNews;
		}
		public function getUser()
		{
			return $this->oUser;
		}
		public function getCatégorie()
		{
			return $this->oCatégorie;
		}
	////////// SET //////////
		public function setTitre($titre){
			if(is_string($titre) == true){
				$this->titre = $titre;
			}
		}
		public function setContenuLong($contenuLong){
			if(is_string($contenuLong) == true ){
				$this->contenuLong = $contenuLong;
			}
		}
		public function setDateAjout($dateAjout){
			$this->dateAjout = $dateAjout;
			// test Ã  faire pour la variable de type date
		}
		public function setDateModificatio($dateModification){
			$this->dateModification = $dateModification;
			// test Ã  faire pour la variable de type date
		}
		public function setEtat($etat){
			if(is_int($etat) == true){
				$this->etat = $etat;
			}
		}
		public function setContenuCourt($contenuCourt){
			if(is_string($contenuCourt) == true){
				$this->contenuCourt = $contenuCourt;
			}
		}
		public function setDossierImage($dossierImage){
			if(is_string($dossierImage) == true){
				$this->dossierImage = $dossierImage;
			}
		}
		public function setDossierNews($dossierNews){
			if(is_int($dossierNews) == true){
				$this->dossierNews = $dossierNews;
			}
		}
		public function setUser(User $oUser)
		{
			$this->oUser = $oUser;
		}
		public function setCategorie(Categorie $oCategorie)
		{
			$this->oCategorie = $oCategorie;
		}
	}
