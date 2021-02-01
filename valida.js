function valida(){

      var opciones = document.getElementById("opciones").selectedIndex;
  		var cedula=document.getElementById("cedula").value;
  		var nombre=document.getElementById("nombre").value;
  		var apellido=document.getElementById("apellido").value;
  		var email   = document.form.correo.value;
      var verif   = /^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]{2,}[.][a-zA-Z]{2,3}$/;
			
		if( opciones == null || opciones == 0 ) {
			alert("Seleccione si es Venezolano o Extranjero");
			return false;
		}
			
  		if (cedula=="") {

  			alert("Ingrese su Cedula");
  			document.getElementById("cedula").focus();
			return false;

  		}

  		if (nombre=="") {

  			alert("Ingresa tus Nombres");
  			document.getElementById("nombre").focus();
  			return false;

  		}
		
		if (apellido=="") {

  			alert("Ingresa tus Apellidos");
  			document.getElementById("apellido").focus();
  			return false;

  		}
		
    if (verif.exec(email) == null){

        alert("Su email es incorrecto");
        document.getElementById("correo").focus();
        return false;
    }else{
        return true;
      }  


  		form.submit();

}

function salir(){

        if (window.confirm("Desea Salir?")) { 
         window.location("index.php");
      }
      
}

function validarnumeros(e){
    tecla = (document.all) ? e.keyCode : e.which;
    
    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8) {
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[0-9]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}

function validarletras(e){
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla==8){
        return true;
    }
        
    // Patron de entrada, en este caso solo acepta numeros
    patron =/[a-zA-Z]/;
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}