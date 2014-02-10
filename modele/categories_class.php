<?php
class Categories
{
	public static $aCategories = array();
	
	public static function getAll()
	{
		if (empty(self::$aCategories))
		{
			$aCategoriesSql = Connexion::select("SELECT * FROM categorie;");
				
			foreach ($aCategoriesSql as $aCategorieSql)
			{
				$oCategorie = new Categorie();
				
				$oCategorie->hydrateFromSql($aCategorieSql);
				
				self::$aCategories[$aCategorieSql['ID_CAT']] = $oCategorie;
			}
		}
		
		return self::$aCategories;
	}
	
	/**
	 * Fonction avec un formulaire qui permet la gestion des catégories
	 */
	public static function getFormGestionCategorie()
	{
		$aCategories = self::getAll();
		
		$sHtml = "";
		
		$sHtml .= "<h2>Liste de vos catégories</h2>";
/*		$sHtml .= "<table>";
		$sHtml .= "<tr>";
		$sHtml .= "<th>Libellé</th>";
		$sHtml .= "</tr>";
		
		foreach ($this->aCategories as $oCategorie)
		{
			$sHtml .= "<tr>";
			$sHtml .= "<td>";
			$sHtml .= $oCategorie->getLibelle();
			$sHtml .= "</td>";
			$sHtml .= "</tr>";
		}
		
		
		$sHtml .= "</table>";
	*/	
		$sHtml .= "<form method=\"POST\">";
		
		$sHtml .= "<label STYLE=\"font-weight:bold\">Libellé</label><br /><br />";
		
		foreach ($aCategories as $oCategorie)
		{
			$sHtml .= "<input id=\"".$oCategorie->getId()."\" name=\"ids[".$oCategorie->getId()."]\" type=\"text\" value=\"".$oCategorie->getLibelle()."\" /><br />";
		}
		
		$sHtml .= "<br /><input type=\"hidden\" id=\"update\" name=\"update\" value=\"1\">";
		$sHtml .= "<input type=\"hidden\" id=\"envoye\" name=\"envoye\" value=\"1\">";
		$sHtml .= "<input type=\"submit\" value=\"Enregistrer les changements\">";
		$sHtml .= "</form>";
		
		$sHtml .= "<br /><h2>Ajouter une catégorie</h2><br />";
		$sHtml .= "<form method=\"POST\">";
		
		$sHtml .= "<label name=\"LIBELE_CAT\">Libellé : </label>";
		$sHtml .= "<input id=\"LIBELE_CAT\" name=\"LIBELE_CAT\" type=\"text\" /><br /><br />";
		$sHtml .= "<input type=\"hidden\" id=\"insert\" name=\"insert\" value=\"1\">";
		$sHtml .= "<input type=\"hidden\" id=\"envoye\" name=\"envoye\" value=\"1\">";
		$sHtml .= "<input type=\"submit\" value=\"Enregistrer\">";
		
		$sHtml .= "</form>";
			
		return $sHtml;
	}
}