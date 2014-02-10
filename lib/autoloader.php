<?php

/**
 * @author AdrienSY
 */

function autoloader($classe)
{
	$repertoires = array(
			"Modèles" => __DIR__."/../modele/",
			"Contrôleurs" => __DIR__."/../controller/"
	);
	
	foreach ($repertoires as $repertoire)
	{
		if (@include_once($repertoire.strtolower($classe)."_class.php")) return true;
	}
	
	return false;
}



spl_autoload_register("autoloader");