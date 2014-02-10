<?php

include_once '../lib/param.php';

if (isset($_POST["connectUser"]))
{
	if(Connexion::connectUser($_POST['pseudo'], $_POST['password']))
	{
		header("Location: news.php");
	}
	else
	{
		echo getMessageKo(array("Pseudo ou mot de passe inccorect"));
	}
}

echo Users::getFormConnexion();