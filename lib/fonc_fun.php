<?php
    //fonction anonyme autoload
    /*spl_autoload_register(function ($class) {
        include 'modeles/' . $class . '._class.php';
    });*/
	
    function get_head(){
		$html ='
        <!DOCTYPE html>
        <html style="width: 1400px;margin:0px">
            <head>
                <meta charset="utf-8" />
                <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
				<link href="./css/all_css.css" rel="stylesheet" type="text/css">
				<script type="text/javascript" src="./_js/fonc_fun.js"></script>

                <title>Titre</title>
        
            </head>
            <body>
        ';
        
		return $html;
	}
	
	/**
	 * Message reussite
	 * @param string $message
	 */
	function getMessageOk($message)
	{
		$sHtml = "";
		
		$sHtml .= "<div id=\"msg_ok\">";
		$sHtml .= "Réussite!<br />";
		$sHtml .= $message;
		$sHtml .= "</div>";
		
		return $sHtml;
	}
	
	/**
	 * Message echec
	 * @param array $message
	 */
	function getMessageKo($aMessages)
	{
		$sHtml = "";
		
		$sHtml .= "<div id=\"msg_ko\">";
		$sHtml .= "Échec!";
		
		$sHtml .= "<table>";
		
		foreach ($aMessages as $message)
		{
			$sHtml .= "<tr>";
			$sHtml .= "<td>- ";
			$sHtml .= $message;
			$sHtml .= "</td>";
			$sHtml .= "</tr>";
		}
		
		$sHtml .= "</table>";
		
		$sHtml .= "</div>";
		
		return $sHtml;
	}
	
	function get_foot(){
		$html ='
		        <footer class="footer">
			        <p>pied</p>
			    </footer>
		    </body>
		</html>
        ';
        
		return $html;
	}
    
    function input_txt($name,$value,$label,$classe,$br) {
		$html = '';
        
        if ($label != 'null') {
            if (!empty($label)) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$classe.'" for="'.$name.'">'.$label.$sep.'</label>';
        }

		$html.= '<input type="text" name="'.$name.'" value="'.$value.'" />';
        if ($br==1) { $html.= '<br />'; }
        
		
		return $html;
	}
	
	function input_pwd($name,$value,$label,$classe,$br) {
		$html = '';
		
        if ($label != 'null') {
            if (!empty($label)) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$classe.'" for="'.$name.'">'.$label.$sep.'</label>';
        }
        
		$html.= '<input type="password" name="'.$name.'" value="'.$value.'" />';
		
        if ($br==1) { $html.= '<br />'; }
		
		return $html;
	}
	
	function input_hidden($name,$value,$label,$classe,$br) {
		$html = '';
        
        if ($label != 'null') {
            if (!empty($label)) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$classe.'" for="'.$name.'">'.$label.$sep.'</label>';
        }
        
		$html.= '<input type="hidden" name="'.$name.'" value="'.$value.'" />';
        
        if ($br==1) { $html.= '<br />'; }
        
		return $html;
	}
	
	function textArea($name,$value,$label,$classe,$br) {
		$html = '';
		
        if ($label != 'null') {
            if (!empty($label)) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$classe.'" for="'.$name.'">'.$label.$sep.'</label>';
        }
        
		$html.= '<textarea name="'.$name.'" rows="8" cols="45">'.$value.'</textarea>';
		
        if ($br==1) { $html.= '<br />'; }
		
		return $html;
	}
	
	function get_table_genre(){
	
		$genre_user = array('Id genre'
							,'Libele genre');
		
	// -------------- une fonction devrai faire cela debut --------------					
		$req_genre = "SELECT * FROM `genre_use`";
		
		
		$db = new connexion();
		//a activé je ne suis pas connecter a une bdd
		//$a_res = $db->pdo_sql_array_assoc($req_genre);
	// -------------- une fonction devrai faire cela fin --------------	
		
		
		
		$a_res = array();


		$html2 = '';
		$html = '';
		foreach($a_res as $key => $val){
			$html2 .= '<tr>
						<td>'.$val->id_genre_use.'</td>
						<td>'.$val->libel_genre_use.'</td>
						<td class="i_toolbar"><i class="fa fa-pencil i_hover" onclick=""/></i></td>
						<td class="i_toolbar"><i class="fa fa-times i_hover" onclick=""/></i></td>
					</tr>';
		
		}
	
		$html .= '
				<div style="margin-left: 300px;">
					<table class="tableau">
						<tr>';
						foreach($genre_user as $value){
							$html .= '<td style="width:120px;">'.$value.'</td>';
						}
				$html .= '	<td ></td>
							<td class="i_toolbar"><i class="fa fa-plus-circle i_hover" /></i></td>
						</tr>			
					'.$html2.'
				</table>
			</div>';
			
		
		return $html;
	
	}
	
	//prototype, pense a passer le id du formulaire avec la fonction en parametre
	function button($type, $fonction_js){
		$html = '';
		$js = '';
		
		switch($type){
			case 'valider' :
					$html .= '<input id="form_bt_val" type="button" class="bt_btn" name="Enregistrer">';
					$js .= "$('#form_bt_val').click( function() { 
								".$fonction_js."
							});
							";
				break;
				
			case 'modifier' :
					$html .= '<input id="form_bt_val" type="button" class="bt_btn" name="Enregistrer">';
					$js .= "$('#form_bt_val').click( function() { 
								".$fonction_js."
							});
							";
				break;
				
			case 'nouveau' :
					$html .= '<input id="form_bt_val" type="button" class="bt_btn" name="Enregistrer">';
					$js .= "$('#form_bt_val').click( function() { 
								".$fonction_js."
							});
							";
				break;
				
			case 'annuler' :
					$html .= '<input id="form_bt_ann" type="button" class="bt_btn" name="Annuler">';
					$js .= "$('#form_bt_ann').click( function() { 
								".$fonction_js."
							});
							";
				break;
				
			case 'supprimer' :
					$html .= '<input id="form_bt_sup" type="button" class="bt_btn" name="Supprimer">';
					$js .= "$('#form_bt_sup').click( function() { 
								".$fonction_js."
							});
							";
				break;
		}
		
		$html .= '<script>
						'.$js.'
					</script>';
		 
		
		return $html;
	}

	//      -------------------------------------------------------------
	//      AJOUTE DES ANTISLASHES À UN ARRAY
	//      -------------------------------------------------------------
	function add_slashes(&$arr_r)
	{
	        foreach($arr_r as & $val) is_array($val) ? add_slashes($val) : $val = addslashes(trim($val));
	        unset($val);
	}
	
	//      -------------------------------------------------------------
	//      SUPPRIME DES ANTISLASHES À UN ARRAY
	//      -------------------------------------------------------------
	function strip_slashes(&$arr_r) {
	        foreach($arr_r as & $val) is_array($val) ? strip_slashes($val) : $val = stripslashes($val);
	        unset($val);
	}
	
	function getMessageNonAutorise()
	{
		$sHtml = "";
		
		$sHtml .= "<div id=\"msg_non_autorise\">";
		$sHtml .= "Vous n'êtes pas autorisé à accéder à cette page<br />";
		$sHtml .= "</div>";
		
		return $sHtml;
	}
	
	function getNav(){
		$sHtml = "";
		$sHtml .="
		<nav class=\"nav\">
			<div id=\"titre_menu\">
				<p align=\"center\"><font size=\"12px\"><font color=\"#348893\">M</font>enu</font></p>
			</div>
			
			<div id=\"menu\" onmouseout=\"lowerFont()\">
				<div class=\"menu\" id=\"menu1\" onmouseover=\"upperFont(this)\">
					<a href=\"#\">Acceuil</a>
				</div>
				<div class=\"menu\" id=\"menu2\" onmouseover=\"upperFont(this)\">
					<a href=\"#\">High-tech</a>
				</div>
				<div class=\"menu\" id=\"menu3\" onmouseover=\"upperFont(this)\">
					<a href=\"#\">Electronique</a>
				</div>
				<div class=\"menu\" id=\"menu4\" onmouseover=\"upperFont(this)\">
					<a href=\"#\">Domotique</a>
				</div>
			</div>
		</nav>";
		return $sHtml;
	}
?>