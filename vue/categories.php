<?php

include_once '../lib/param.php';

$sHtml = "";

if (isset($_POST["envoye"]))
{
	$categorie = new Categorie();
	
	if (isset($_POST["insert"]))
	{
		$categorie->hydrateFromPost($_POST);
	
		if ($categorie->insert())
		{
			$sHtml .= getMessageOk("Enregistrement de la nouvelle catégorie réussi.");
		}
		else
		{
			$sHtml .= getMessageKo(array("Enregistrement de la nouvelle catégorie échoué."));
		}
	}
	else
	{
		$errors = array();
		
		if (isset($_POST["ids"]))
		{
			foreach ($_POST["ids"] as $id => $libelle)
			{
				$categorie = new Categorie($id);
				
				$categorie->setLibelle($libelle);
				
				if (!$categorie->update()) $errors[] = "Enregistrement de la catégorie ".$libelle." échoué";
			}
			
			if (empty($errors))
			{
				$sHtml .= getMessageOk("Enregistrement des modifications réussi.");
			}
			else
			{
				$sHtml .= getMessageKo($errors);
			}
		}
	}
}

$sHtml.= Categories::getFormGestionCategorie();

echo $sHtml;

?>