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
			$sHtml .= getMessageOk("Enregistrement de la nouvelle cat�gorie r�ussi.");
		}
		else
		{
			$sHtml .= getMessageKo(array("Enregistrement de la nouvelle cat�gorie �chou�."));
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
				
				if (!$categorie->update()) $errors[] = "Enregistrement de la cat�gorie ".$libelle." �chou�";
			}
			
			if (empty($errors))
			{
				$sHtml .= getMessageOk("Enregistrement des modifications r�ussi.");
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