<?php

/**
 * @author AdrienSY
 */

include_once __DIR__.'/../vue/categories.php';

$oCategorie = new Categorie();

if (isset($_POST['insert']))
{
	$oCategorie->hydrateFromPost($_POST);
	
	if ($oCategorie->save())
	{
		header("Location: ".RACINE_SITE."?page=categories&isOk=1&insert=1");
	}
	else
	{
		header("Location: ".RACINE_SITE."?page=categories&isOk=0&insert=1");
	}
}

if (isset($_POST['update']))
{
	$errors = array();
	
	foreach ($_POST['ids'] as $id => $libelle)
	{
		$oCategorie->getById($id);
		$oCategorie->setLibelle($libelle);
		
		if (!$oCategorie->save())
		{
			$errors[$id] = "Échec de l'insertiono du libellé ".$libelle;
		}
	}
	
	if (empty($errors))
	{
		header("Location: ".RACINE_SITE."?page=categories&isOk=1&update=1");
	}
	else
	{
		header("Location: ".RACINE_SITE."?page=categories&isOk=0&update=1");
	}
}

?>