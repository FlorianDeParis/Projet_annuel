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
			$sHtml .= getMessageOk("News enregistr�e");
		}
		else
		{
			$sHtml .= getMessageKo(array("L'enregistrement de la news a �chou�"));
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