<?php

class Genres
{
	const GENRE_ADMINISTRATEUR = 1;
	const GENRE_MODERATEUR = 2;
	const GENRE_REDACTEUR = 3;
	const GENRE_MEMBRE = 4;
	
	static $libelleGenre = array(
								1 => "Administrateur",
								2 => "Modérateur",
								3 => "Rédacteur",
								4 => "Membre",
							);
	
	// Les différents profils
	public static $aGenres = array();
	
	public static function getGenre($idGenre)
	{
		if (empty(self::$aGenres))
		{
			self::getAll();
		}
		
		return self::$aGenres[$idGenre];
	}
	
	public static function getAll()
	{
		$aGenresSql = Connexion::select("SELECT * FROM genre_use;");
			
		foreach ($aGenresSql as $aGenreSql)
		{
			$oGenre = new Genre();
		
			$oGenre->hydrateFromSql($aGenreSql);
		
			self::$aGenres[$aGenreSql['ID_GENRE_USE']] = $oGenre;
		}
		
		return self::$aGenres;
	}
}