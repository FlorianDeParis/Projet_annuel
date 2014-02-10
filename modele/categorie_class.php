<?php
	class Categorie
	{
		private $id;
		private $libelle;
		
        //fonction qui verifie le status des catégories
        
		public function __construct($id = false)
		{
			if ($id)
			{
				$this->getById($id);
			}
		}
		
		public function hydrateFromSql($aCategorieSql)
		{
			$this->id = $aCategorieSql['ID_CAT'];
			$this->libelle = $aCategorieSql['LIBELE_CAT'];
		}
		
		public function hydrateFromPost($aCategoriePost)
		{
			if (isset($aCategoriePost['ID_CAT']))		$this->id = $aCategoriePost['ID_CAT'];
			if (isset($aCategoriePost['LIBELE_CAT']))	$this->libelle = $aCategoriePost['LIBELE_CAT'];
		}
		
		public function getById($id)
		{
			$result = Connexion::select(sprintf("SELECT * FROM categorie WHERE ID_CAT = %d",$id));
				
			if (!empty($result))
			{
				$result = $result[0];
				
				$this->id = $result['ID_CAT'];
				$this->libelle = $result['LIBELE_CAT'];
				
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
			return Connexion::delete(sprintf("DELETE FROM categorie WHERE ID_CAT = %d", $this->id));
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function getLibelle()
		{
			return $this->libelle;
		}
	
		public function setLibelle($libelle)
		{
			if(is_string($libelle) == true)
			{ 
				$this->libelle = $libelle; 
			}
		}

		public function insert()
		{
			return Connexion::insert(sprintf("INSERT INTO categorie(LIBELE_CAT) VALUES(\"%s\")", $this->libelle));
		}
		
		public function update()
		{
			return Connexion::insert(sprintf("UPDATE categorie SET LIBELE_CAT = \"%s\" WHERE ID_CAT = %d", $this->libelle, $this->id));
		}
	}

