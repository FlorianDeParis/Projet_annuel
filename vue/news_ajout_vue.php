<?php

include_once '../lib/param.php';

$sHtml = "";

if (isset($_SESSION["user"]["id"]))
{
	$news = new News();
	
	if (isset($_POST["envoye"]))
	{
		$news->setFromPost($_POST);
		
		if ($news->save())
		{
			$sHtml .= getMessageOk("News enregistrée");
		}
		else
		{
			$sHtml .= getMessageKo(array("L'enregistrement de la news a échoué"));
		}
	}
	
	$sHtml.= newsListe::getFormCreation();
}
else
{
	$sHtml .= getMessageNonAutorise();
}
	
echo $sHtml;
?>