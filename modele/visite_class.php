<?php

    //Tache a faire
    // fonction qui retourne le compteur mit en forme []
    // fonction qui retourne juste le nombre max d'ip enregistrÃƒÂ© []
    // fonction qui retourne le nombre d'ip unique []
    
    // fonction qui recupere l'ip du visiteur courant  []
    // fonction qui test si l'ip existe deja dans la base pour la journÃƒÂ©e actuel ou que l'ip du proxy n'existe pas deja []
    // fonction qui ajout l'ip et la date dans la base []
    // fonction de suppression d'une ip au cas ou []
    // fonction de rÃƒÂ©cupÃƒÂ©ration de d'ip derriere un proxy []
	
	class Visite
	{
		private $id_visite;
		private $date_visite;
		private $ip_visite;
		private $statusip;
		private $numip;
		private $totalip;
		
		private $bdd;
		private $req;
		private $uniqueip;
		

		public function __construct($bdd, $req, $ip_visite, $statusip, $date_visite, $numip, $uniqueip, $totalip){

		
			try{
			
				$this->setIdVisite($newIdVisite);			// id_visite
				$this->setDateVisite($newDateVisite);		// date_visite
				$this->setIpVisite($newIpVisite);			// ip_visite
				$this->setStatusIp($newStatusIp);			// statusip
				$this->setTotalIp($newTotalIp);
			
			}
			catch(Exception $error){ //Afficher rapport d'erreur en cas d'erreur
				echo  $error -> getMessage();
			}
		}
		

		// Fonction d'hydratation =>   Format DonnŽes attendu
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
                // On rŽcup�re le nom du setter correspondant ˆ l'attribut.
                $method = 'set'.ucfirst($key);
                
                // Si le setter correspondant existe.
                if (method_exists($this, $method)){
                    // On appelle le setter.
                    $this->$method($value);
                }
            }
        }

		// Recuperation de l'adresse IP de l'utilisateur actuel
		public function ipaddress(){
			if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) ){ //Si la récupération IP derrière un proxi est possible
				$ip_visite =	$_SERVER['HTTP_X_FORWARDED_FOR']; // récupération IP derrière un proxi
			}
			else{																				// Sinon, récupération IP standard
				$ip_visite = $_SERVER['REMOTE_ADDR'];
			}
			return  $ip_visite;
		}
			
		// Recuperation de la date actuelle
		public function dateknown(){
			$date_visite = date("Y-m-d");
			return $date_visite;
		}
	
		// Ajout de l'adresse IP et la date dans la BDD
		public function addiptime(){
                                                    $req = "INSERT INTO visite (date_vis, ip_vis) VALUES ($date_visite,$ip_visite)";
                                                    $resultat = pdo_sql_objet($req);
                                                    return $resultat;
		}
		
		// Supression de l'adresse IP et la date dans la BDD
		public function deliptime(){
                                                    $req = "DELETE ip_vis FROM visite WHERE date_vis = $date_visite";
                                                    $resultat = pdo_sql_objet($req);
                                                    return $resultat;
		}
	
		// Fonction qui teste et vérifie l'existence de l'adresse ip pendant le jour actuel
		public function ifipexiststoday(){
			$req = "SELECT ip_vis FROM visite WHERE date_vis = $date_visite AND $ip_visite";
                                                                $resultat = pdo_sql_objet($req);
                                                                
			if($req == NULL){
				echo "cette adresse IP n'est pas inscrite aujourd'hui dans la base de donnÃƒÂ©es";
			}
			else{
				echo "cette adresse IP est dÃƒÂ©jÃƒÂ  inscrite aujourd'hui dans la base de donnÃƒÂ©es";
			}
		}
		
		// Fonction qui retourne le nombre total d'adresses IP enregistrées
		public function totalipnumber(){
			$numip = "SELECT COUNT(*) FROM visite";
			$totalip = pdo_sql_objet($numip);
                                                                return $totalip;
		}
		
		// Fonction qui retourne le nombre d'adresses  IP uniques
		public function uniqueipcount(){
			$uniqueip = "SELECT DISTINCT $ip_visite FROM visite";
			$resultat = pdo_sql_objet($uniqueip);
			return $resultat;
		}
                
		// Fonction qui  met en forme l'affichage
                                         public function ipdisplay(){
                                                                 echo "<head>
                                                                                    <link rel='stylesheet' type='text/css' href='affichage.css' media='screen' />
                                                                            </head>
                                                                            <body>
                                                                                    <table id='affichage' border='0' style='border:4px; border-style:inset; border-color: #5C3706; border-radius: 10px; '>
                                                                                            <tr>
                                                                                                    <td align='center'>Vous Ãªtes connectÃ© avec l'adresse IP suivante: $ip_visite </td>
                                                                                            </tr>
                                                                                            <tr><td  align='center'>parmis les $totalip visiteurs</td></tr>
                                                                                    </table>
                                                                            </body>";}
		
	////////////////////// Accesseur /////////////////////
	////////// GET //////////
		public function getIdVisite(){ 
			return $this->id_visite;
		}
		public function getDateVisite(){
			return $this->date_visite;
		}
		public function getIpVisite(){
			return $this->ip_visite;
		}
		public function getStatusIp(){
			return $this->statusip;
		}
		public function getTotalIp(){
			return $this->totalip;
		}
	
	//////////// SET //////////
		public function setIdVisite($newIdVisite){
			if(is_string($id_visite) == true){
				$this->id_visite = $newIdVisite;
			}
		}
		public function setDateVisite($newDateVisite){
			$this->date_visite = $newDateVisite;
			// test à faire pour la variable de type date
		}
		public function setIpVisite($newIpVisite){
			if(is_string($ip_visite) == true){
				$this->ip_visite = $newIpVisite;
			}
		}
		public function setStatusIp($newStatusIp){
			if(is_string($statusip) == true){
				$this->statusip = $newStatusIp;
			}
		}
		public function setTotalIp($newTotalIp){
			if(is_int($totalip) == true){
				$this->totalip = $newTotalIp;
			}
		}
	}

?>
