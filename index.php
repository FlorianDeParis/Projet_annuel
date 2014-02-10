<?php

    session_start();
 include_once './lib/param.php';

 
/*
 $news = new News(2);
 die(var_dump($news));
*/
 
    //On inclut le contrôleur s'il existe et s'il est spécifié
 /*
   if (!empty($_GET['page']) && is_file('controller/'.$_GET['page'].'.php')){
        include 'controller/'.$_GET['page'].'.php';
    }
*/
?>

<?php
	echo get_head();
?>

	<header class="header">
		<table>
			<tr height="100px">
				<td width="160px"><img src="./logo/logo.png" style="margin-left:2px; height:23%; padding:0px"></td>
				<td width="1240px" align="center"><label class="titre_banniere">LE PREMIER SITE D'ACTUALITES NUMERIQUES</label></td>
			</tr>
		</table>
		<!--<div class="logo"><img src="./logo/logo.png" style="height:12%; width:12%"></div>
	    <div class="titre_banniere"><p>LE PREMIER SITE D'ACTUALITES NUMERIQUES</p></div>-->
	</header>
	
<?php
	echo getNav();
?>
	
	
	<div id="body" class="body" style="border-collapse:collpse;'">
		<div id="titre_body" style ='width:150px; border-collapse:collpse;'>
			<p><font size="12px"><font color="#348893">B</font>ody</font></p>
		</div>
		
			<?php
				// pour exemple
				//echo get_table_genre();

			?>

		<?php

			function get_form_genre($id_genre){

			if($id_genre > 0){
				//alors c'est une modification 
				
				// -------------- une fonction devrait faire cela debut --------------					
					$req_genre = "SELECT * FROM `genre_use` WHERE `id_genre_use` = ".$id_genre;
					
					
					$db = new connexion();
					//a activÃ© je ne suis pas connecter a une bdd
					//$a_res = $db->pdo_sql_array_assoc($req_genre);
				// -------------- une fonction devrait faire cela fin --------------	

				$s_libel = $a_res['libel_genre_use'];
				$button = button('modifier', 'newGenre();');

			}
			else{
				//alors c'est un nouveaux
				$s_libel = '';
				
				$button = button('nouveau', 'newGenre();');
			}
								
					
					
					$html = '';
					$genre_user = array('Id genre'
								,'Libele genre');
				
					$html .= '
							<div style="margin-left: 300px;">
								<form class="formulaire" id="form_genre">
								
								
										<table class="tableau">
											<tr>
												<td style="width:120px;">Libele genre</td>
											
										
											</tr>			
											<tr>
												<td style="width:120px;">
													'.input_txt('libel_genre',$s_libel,'Genre Utilisateur','',0).'
												</td>									
											</tr>
											<tr>
												<td style="width:120px;">
													'.button('annuler', '').'
													'.$button.'
												</td>	
											</tr>
										
										</table>
								</form>
							</div>';
						
					
					return $html;
				
				}
				
			
				echo newsListe::getFormListeOrderDate();
		?>







	</div>
<?php
	echo get_foot();
?>
