
<?php
include_once "./../fonc_fun.js";
	class Mail{
		private $id_mail;
		private $contenu_mail;
		private $expediteur_mail;
		private $objet_mail;
		private $date_envoi_mail;	
		
		public function __construct(){
		
		}
    
    //Tache a faire
    //fonction qui affiche un formulaire envoi email
    //fonction qui test la validité d'une adresse email
    //fonction qui valide le contenu du email
    //fonction qui envoi le email
    //surement une fonction pour envoyer un email automatiquement a valider
		function formulaire_mail($href)
		{
			$formulaire = "";
			$formulaire .= "<table border='0'>";
			$formulaire .="<form method='post' name='form'  action='mail_class.php'><tr><td>";
			$formulaire .= "<label> Nom: </label>";
			$formulaire .= "</td><td>";
			$formulaire .= "<input type ='text' name='name' id='id_name' onblur=\"isName('id_name')\">";
			$formulaire .= "</td></tr><tr><td>";
			$formulaire .= "<label> Pr&eacutenom: </label>";
			$formulaire .= "</td><td>";
			$formulaire .= "<input type ='text' name='firstname' id='id_first_name' onblur=\"isPassword('id_first_name')\">";
			$formulaire .= "</td></tr><tr><td>";
			$formulaire .="<label>Adresse e-mail:</label>"; 
			$formulaire .= "</td><td>";
			$formulaire .="<input type='text' name='email' id='id_email' onblur=\"isEmail('id_email')\">";
			$formulaire .= "</td></tr><tr><td>&nbsp</td><td>";
			$formulaire .= "<textarea type='text' name='message' id='id_message' class='message-field text-field autoclear' style ='width:400px; height:400px;'></textarea>";
			$formulaire .= "</td></tr><tr><td>&nbsp</td><td><input type='submit'  value ='Envoyer' /></td></tr></form></table>";
		echo $formulaire ;
		}
		
		function valide_mail()
		{
			$flag=1;
			$erreur = "";
			if(isset($_POST["form"]))
			{
				//echo "passe";
				$name = $_POST["id_name"];
				//echo $name;
				$first_name= $_POST["id_first_name"];
				//echo $first_name;
				$bdd = "SELECT 'ID_USE' FROM 'utilisateur' WHERE ('NOM_USE', 'PRENOM_USE') VALUES ('".$name."','".$first_name."')";
				$id_user = Connexion::select($bdd);
				
				if( preg_match("/^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$/", $_POST["id_email"]) != 1)
				{
					$flag=0;
					$erreur .= "email incorrect, ";
				}
				if( preg_match("/^[A-zA-Z]+(([\'\\\-.]?[A-zA-Z])[a-zA-Z]*)*$/", $_POST["id_name"]) != 1)
				{
					$flag=0;
					$erreur .= " nom incorrect, ";
				}
				if( preg_match("/^[A-zA-Z]+(([\'\\\-.]?[A-zA-Z])[a-zA-Z]*)*$/", $_POST["id_first_name"]) != 1)
				{
					$flag=0;
					$erreur .= " prenom incorrect, ";
				}
					echo $erreur;
					echo "<script>alert('".$erreur."')</script>";
				
			}
			else $flag = 0;
			if($flag==1)
			{
				if( $id_user !="")
				{
					$bdd = "INSERT INTO 'mail'('ID_MAIL', 'ID_USE', 'CONTENU_MAIL', 'DATE_MAIL') VALUES ('',".$id_use.",".$message.",".date("d-m-Y").")";
					Connexion::select($bdd);
					return true;
			
				}
				else
				{
					$bdd="INSERT INTO utilisateur('ID_GENRE_USE','NOM_USE','PRENOM_USE','EMAIL_USE') VALUES ('','".$_POST["id_name"]."','".$_POST["id_first_name"]."','".$_POST["id_email"]."')";
					Connexion::insert($bdd);
					$bdd = "SELECT 'ID_USE' FROM 'utilisateur' WHERE ('NOM_USE', 'PRENOM_USE') VALUES ('".$name."','".$first_name."')";
					$id_user = Connexion::select($bdd);
					$bdd = "INSERT INTO 'mail'('ID_MAIL', 'ID_USE', 'CONTENU_MAIL', 'DATE_MAIL') VALUES ('',".$id_use.",".$message.",".date("d-m-Y").")";
					Connexion::select($bdd);
					return true;
				}
			}
			else
			{
				return false;
			}
			
		}
		function insert_mail_bdd($message,$id_use){
			$bdd="";
			$bdd = "INSERT INTO 'mail'('ID_MAIL', 'ID_USE', 'CONTENU_MAIL', 'DATE_MAIL') VALUES ('',".$id_use.",".$message.",".date("d-m-Y").")";
			return Connexion::select($bdd);  
		}
		function delete_mail_bdd($id){
			$bdd = "";
			$bdd ="DELETE FROM `mail` WHERE ".$id;
			return Connexion::select($bdd);
		}
		
        
        // Fonction d'hydratation =>   Format Données attendu
        //    $donnees = array(
        //                     3  'id' => 16,
        //                     4  'nom' => 'Vyk12',
        //                     5  'forcePerso' => 5,
        //                     6  'degats' => 55,
        //                     7  'niveau' => 4,
        //                     8  'experience' => 20
        //                     9);
        
        public function hydrate(array $donnees){
            foreach ($donnees as $key => $value){
                // On récupère le nom du setter correspondant à l'attribut.
                $method = 'set'.ucfirst($key);
                
                // Si le setter correspondant existe.
                if (method_exists($this, $method)){
                    // On appelle le setter.
                    $this->$method($value);
                }
            }
        }
        
		
	/////////////////////////// Accesseur ////////////////////////////
	////////// GET //////////
		public function getContenu_mail(){
			return $this->contenu_mail;
		}
		public function getExpediteur_mail(){
			return $this->expediteur_mail;
		}
		public function getObjet_mail(){
			return $this->objet_mail;
		}
		public function getDateEnvoi_mail(){
			return $this->date_envoi_mail;
		}
		
		
		
		
			////////// SET //////////
		public function setContenu_mail($newContenu_mail){
			if(is_string($contenu_mail) == true){
				$this->contenu_mail = $newContenu_mail;
			}
		}
		public function setExpediteur_mail($newExpediteur_mail){
			if(is_string($expediteur_mail) == true){
				$this->expediteur_mail = $newExpediteur_mail;
			}
		}
		public function setObjet_mail($newObjet_mail){
			if(is_string($objet_mail) == true){
				$this->objet_mail = $newObjet_mail;
			}
		}
		public function setDateEnvoi_mail($newDateEnvoi_mail){
			$this->date_envoi_mail = $newDateEnvoi_mail;
			// test à faire pour la variable de type date
		}
		
		
		
			
	}

$x = new mail();
echo"<html><head></head><body>";
$x -> formulaire_mail($href = 'mail_class.php');
echo"</body></html>";