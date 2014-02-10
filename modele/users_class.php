<?php
<<<<<<< HEAD
<<<<<<< HEAD

/**
 * @author AdrienSY
 */

class Users
{
	
=======
class Users
{
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
=======
class Users
{
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
	public static $aUsers = array();
	
	public static function getAll()
	{
		$aUsersSql = Connexion::select("SELECT * FROM utilisateur;");
			
		foreach ($aUsersSql as $aUserSql)
		{
			$oUser = new User();
				
			$oUser->hydrateFromSql($aUserSql);
				
			self::$aUsers[$aUserSql['ID_USE']] = $oUser;
		}
		
		return self::$aUsers;
	}
	
	public static function getUsers()
	{
		if (empty(self::$aUsers))
		{
			self::getAll();
		}
		
		return self::$aUsers;
	}
	
	/**
	 * Fonction qui liste les utilisateurs et permet de les supprimer
	 */
	public static function getFormListeUtilisateur()
	{
		$aUsers = self::getUsers();
		
		$sHtml = "";
	
		$sHtml .= "<h2>Utilisateurs</h2>";
		
		$sHtml .= "<table>";
		$sHtml .= "<tr>";
		$sHtml .= "<th>Genre</th>";
		$sHtml .= "<th>Nom</th>";
		$sHtml .= "<th>Prénom</th>";
		$sHtml .= "<th>Email</th>";
		$sHtml .= "<th>Pseudo</th>";
		$sHtml .= "</tr>";
		
		foreach (self::$aUsers as $oUser)
		{
			$sHtml .= "<tr>";
			
			$sHtml .= "<td>".Genres::$libelleGenre[$oUser->getGenreId()]."</td>";
			$sHtml .= "<td>".$oUser->getNom()."</td>";
			$sHtml .= "<td>".$oUser->getPrenom()."</td>";
			$sHtml .= "<td>".$oUser->getEmail()."</td>";
			$sHtml .= "<td>".$oUser->getPseudo()."</td>";
			$sHtml .= "<td><a href=\"#\">Supprimer</a></td>";
			
			$sHtml .= "</tr>";
		}
		
<<<<<<< HEAD
<<<<<<< HEAD
		
=======
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
=======
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
		$sHtml .= "</table>";
		
		return $sHtml;
	}
	
	/**
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
	 * Fonction qui affiche le formulaire de connexion
	 */
	public static function getFormConnexion()
	{
		$sHtml = "";
	
		$sHtml .= "<h2>Connexion</h2>";
	
		$sHtml .= "<form method=\"POST\">";
	
		$sHtml .= "<label name=\"pseudo\">Pseudo : </label>";
		$sHtml .= "<input id=\"pseudo\" name=\"pseudo\" type=\"text\" /><br /><br />";
	
		$sHtml .= "<label name=\"password\">Mot de passe : </label>";
		$sHtml .= "<input id=\"password\" name=\"password\" type=\"text\" /><br /><br />";
	
		$sHtml .= "<input type=\"hidden\" id=\"connectUser\" name=\"connectUser\" value=\"1\">";
		$sHtml .= "<input type=\"submit\" value=\"Se connecter\">";
	
		$sHtml .= "</form>";
		
		return $sHtml;
	}
	
	/**
<<<<<<< HEAD
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
=======
>>>>>>> 87ca11fa80e652692acfaf80c7c057bc2e1e9fc6
	 * Fonction qui affiche le formulaire d'inscription
	 */
	public static function getFormInscription()
	{
		$sHtml = "";
		
		$sHtml .= "<h2>Inscription</h2>";

		$sHtml .= "<form method=\"POST\">";
		
		$sHtml .= "<label name=\"nom\">Nom : </label>";
		$sHtml .= "<input id=\"nom\" name=\"nom\" type=\"text\" /><br /><br />";
		
		$sHtml .= "<label name=\"prenom\">Prénom : </label>";
		$sHtml .= "<input id=\"prenom\" name=\"prenom\" type=\"text\" /><br /><br />";
		
		$sHtml .= "<label name=\"email\">Email : </label>";
		$sHtml .= "<input id=\"email\" name=\"email\" type=\"text\" /><br /><br />";
		
		$sHtml .= "<label name=\"pseudo\">Pseudo : </label>";
		$sHtml .= "<input id=\"pseudo\" name=\"pseudo\" type=\"text\" /><br /><br />";
		
		$sHtml .= "<label name=\"password\">Password : </label>";
		$sHtml .= "<input id=\"password\" name=\"password\" type=\"password\" /><br /><br />";
		
		$sHtml .= "<input type=\"hidden\" id=\"insert\" name=\"insert\" value=\"1\">";
		$sHtml .= "<input type=\"submit\" value=\"S'inscrire\">";
		
		$sHtml .= "</form>";
			
		return $sHtml;
	}
	
	/**
	 * Fonction qui affiche le formulaire de modification
	 * @param User $oUser L'utilisateur à modifier
	 */
	public static function getFormModification(User $oUser)
	{
		$sHtml = "";
	
		$sHtml .= "<h2>Modifier mes informations</h2>";
	
		$sHtml .= "<form method=\"POST\">";
	
		$sHtml .= "<label name=\"nom\">Nom : </label>";
		$sHtml .= "<input id=\"nom\" name=\"nom\" type=\"text\" value=\"".$oUser->getNom()."\" /><br /><br />";
	
		$sHtml .= "<label name=\"prenom\">Prénom : </label>";
		$sHtml .= "<input id=\"prenom\" name=\"prenom\" type=\"text\" value=\"".$oUser->getPrenom()."\" /><br /><br />";
	
		$sHtml .= "<label name=\"email\">Email : </label>";
		$sHtml .= "<input id=\"email\" name=\"email\" type=\"text\" value=\"".$oUser->getEmail()."\" /><br /><br />";
	
		$sHtml .= "<label name=\"pseudo\">Pseudo : </label>";
		$sHtml .= "<input id=\"pseudo\" name=\"pseudo\" type=\"text\" value=\"".$oUser->getPseudo()."\" /><br /><br />";
	
		$sHtml .= "<label name=\"password\">Password : </label>";
		$sHtml .= "<input id=\"password\" name=\"password\" type=\"password\" /><br /><br />";
	
		$sHtml .= "<input type=\"hidden\" id=\"insert\" name=\"insert\" value=\"1\">";
		$sHtml .= "<input type=\"submit\" value=\"S'inscrire\">";
	
		$sHtml .= "</form>";
			
		return $sHtml;
	}
}