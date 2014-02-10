function newGenre(){
	var dataForm = $('#form_genre').serializeArray();

	
	$.ajax({
		type: "POST",
		processData: true,
		url: './ajax/ajx_add_genre.php',
		data: dataForm,
		dataType: 'html',
		success: function(Data) {
			
		}
	});
}


/* ######## Fonctions pour l'animation du menu ########*/

function upperFont(obj){
		lowerFont();
		var lienThis = obj.getElementsByTagName('a');
		lienThis[0].className = "big";
		var nextId = parseInt(obj.id.substring(4,5))+1;
		var prevId = obj.id.substring(4,5)-1;
		if(document.getElementById('menu'+nextId)){
			var lienNext = document.getElementById('menu'+nextId).getElementsByTagName('a');
			lienNext[0].className= "medium";
		}
		if(document.getElementById('menu'+prevId)){
			var lienPrev = document.getElementById('menu'+prevId).getElementsByTagName('a');
			lienPrev[0].className= "medium";
		}
}

function lowerFont(){
		var containers = document.getElementById('menu').getElementsByTagName('div');
		var nbContainers = containers.length;
		for(var i = 0; i < nbContainers; i++){
			containers[i].getElementsByTagName('a')[0].className ="" ;
		}
}

/* #############################################*/


	function isEmail(myVar){
     // La 1ère étape définir l'expression régulière d'une adresse email
     var mail = document.getElementById(myVar).value;
	
	 var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$');
     var result = regEmail.test(mail);
	 
	if(result == true){
		document.getElementById(myVar).style.color="black";
	}
	else
	{
		//alert('test');
		//document.forms["form"].elements["id_email"].style.color="red";
		// document.getElementById("id_email").style.color="red";
		
		document.getElementById(myVar).style.color="red";
	}
   }
   
   function isName(myVar){
     // La 1ère étape définir l'expression régulière d'une adresse nom
     var mail = document.getElementById(myVar).value;
	
	 var regEmail = new RegExp('^[A-zA-Z]+(([\'\\\-.]?[A-zA-Z])[a-zA-Z]*)*$');
     var result = regEmail.test(mail);
	 
	if(result == true){
		document.getElementById(myVar).style.color="black";
	}
	else
	{
		document.getElementById(myVar).style.color="red";
	}
   }
   
   function isFirstName(myVar){
     // La 1ère étape définir l'expression régulière d'une adresse nom
     var mail = document.getElementById(myVar).value;
	
	 var regEmail = new RegExp('^[A-zA-Z]+(([\'\\\-.]?[A-zA-Z])[a-zA-Z]*)*$');
     var result = regEmail.test(mail);
	 
	if(result == true){
		document.getElementById(myVar).style.color="black";
	}
	else
	{
		document.getElementById(myVar).style.color="red";
	}
   }
   
   function isPassword(myVar){
   // La 1ère étape définir l'expression régulière d'une adresse mot de passe
     var mail = document.getElementById(myVar).value;
	
	 var regEmail = new RegExp('^(?=.*\d)(?=.*[a-zA-Z]).{4,20}$'); //une chaîne de 4 à 20 caractères où il doit y avoir au moins une lettre et au moins un chiffre.
     var result = regEmail.test(mail);
	 
	if(result == true){
		document.getElementById(myVar).style.color="black";
	}
	else
	{
		
		document.getElementById(myVar).style.color="red";
	}
   }
