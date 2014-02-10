<?php
class newsListe
{
	const THEME_1 = 1;
	const CATEGORIE_TEST1 = 2;
	
	public static $aNewsListe = array();
	public static $aThemes = array(
								1 => "Theme 1",
								2 => "Test1"
							);
	
	public static function getNews($idNews)
	{
		if (empty(self::$aNewsListe))
		{
			self::getAll();
		}
		
		return self::$aNewsListe[$idNews];
	}
	
	public static function getAll()
	{
		$aNewsListeSql = Connexion::select("SELECT * FROM news ORDER BY DATE_MODIF_NEWS DESC;");
			
		foreach ($aNewsListeSql as $aNewsSql)
		{
			$oNews = new News();
		
			$oNews->hydrateFromSql($aNewsSql);
		
			self::$aNewsListe[$aNewsSql['ID_NEWS']] = $oNews;
		}
		
		return self::$aNewsListe;
	}
	
	/**
	 * Fonction qui liste les news d'une catégorie
	 * @param unknown_type $idTheme
	 */
	public static function getByTheme($idTheme)
	{
		$aNewsListe = array();
		$aNewsListeSql = Connexion::select("SELECT * FROM news WHERE ID_CAT = ".$idTheme." ORDER BY DATE_MODIF_NEWS DESC;");
		
		foreach ($aNewsListeSql as $aNewsSql)
		{
			$oNews = new News();
			
			$oNews->hydrateFromSql($aNewsSql);
			
			$aNewsListe[$aNewsSql['ID_NEWS']] = $oNews;
		}
		
		return $aNewsListe;
	}
	
	/**
	 * Fonction qui liste les news par thème
	 */
	public static function getFormListeByTheme()
	{
		$sHtml = "<h1>Les news</h1>";
		
		foreach (self::$aThemes as $idTheme => $theme)
		{
			$newsListe = array();
			$newsListe = self::getByTheme($idTheme);
			
			if (empty($newsListe))
			{
				continue;
			}
			
			$sHtml .= "<h2>".self::$aThemes[$idTheme]."</h2>";
			
			foreach($newsListe as $news)
			{
				$date = strtotime($news->getDateModification());
					
				$sHtml .= '
				<div class="news">
				<h3>'.$news->getTitre().'</h3>
				<p>News postée le '.date("d/m/Y", $date).' à '.date("H:i:s", $date).' par '.$news->getUser()->getPseudo().'</p>
				<p>'.$news->getContenuLong().'</p>
				</div>';
			}
		}
		
		return $sHtml;
	}
	
	/**
	 * Fonction qui affiche le formulaire de création d'une nouvelle news
	 */
	public static function getFormCreation()
	{
		$sHtml = "";
		
		$sHtml .= "<h2>Nouvelle news</h2>";
		
		$sHtml .= "<form method=\"POST\">";
		
		//TODO: BOUTON RADIO LISTANT LES CATEGORIES
		
		$sHtml .= "<label name=\"titre\">Titre : </label>";
		$sHtml .= "<input id=\"titre\" name=\"titre\" type=\"text\" /><br /><br />";
	
		$sHtml .= "<label name=\"contenu\">Contenu : </label>";
		$sHtml .= "<input id=\"contenu\" name=\"contenu\" type=\"textarea\" /><br /><br />";
		
		$sHtml .= "<input type=\"hidden\" id=\"id_user\" name=\"id_user\" value=\"".$_SESSION["user"]["id"]."\">";
		$sHtml .= "<input type=\"hidden\" id=\"insert\" name=\"insert\" value=\"1\">";
		$sHtml .= "<input type=\"hidden\" id=\"envoye\" name=\"envoye\" value=\"1\">";
		
		$sHtml .= "<input type=\"submit\" value=\"Enregistrer\">";
		
		$sHtml .= "</form>";
			
		return $sHtml;
	}
	
	/**
	 * Fonction qui liste les news par ordre de date de modification
	 */
	public static function getFormListeOrderDate()
	{
		$sHtml = "<h1>Les news</h1>";
		
		$newsListe = self::getAll();
		
		if (empty($newsListe))
		{
			return $sHtml;
		}
		
		foreach($newsListe as $news)
		{
			$date = strtotime($news->getDateModification());
			
			$sHtml .= '
			<div class="news">
			<h2>'.utf8_encode($news->getTitre()).'</h2>
			<p>News postée le '.date("d/m/Y", $date).' à '.date("H:i:s", $date).' par '.$news->getUser()->getPseudo().'</p>
			<p>'.$news->getContenuLong().'</p>
			</div>';
		}
		
		return $sHtml;
	}
}