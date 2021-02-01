<?php
		session_start();
       // Librería con las funciones de PHP
		include ("libreria.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Consulta Recibo de Pago</title>
	<meta content="Recibo de Pago - Educonsult C.A" name="description">
	<meta content="Educación, educación, Consulta Pago, consulta pago, Recibo de Pago, recibo de pago" name="keywords">
	<!--<script src="query/dist/inputmask/jquery.inputmask.js" type="text/javascript"></script>
	<script src="query/js/jquery.inputmask.js" type="text/javascript"></script>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
	<script src="valida.js"></script>
	<script src="js/jquery-1.9.1.js" type="text/javascript"></script>
	<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <script>
    jQuery(function($){
    $("#fecnac").mask("99/99/9999");
    });
    </script>
	<script language="javascript">

function solo_numero_sin_enter(evt){
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57
	var nav4 = window.Event ? true : false;
	var key = nav4 ? evt.which : evt.keyCode;
	return (key<=0 || (key >= 48 && key <= 57));
}

// este script hace que tabule el enter !!!
function tabular(e,obj) 
        {
            tecla=(document.all) ? e.keyCode : e.which;
            if(tecla!=13) return;
            frm=obj.form;
            for(i=0;i<frm.elements.length;i++) 
                if(frm.elements[i]==obj) 
                { 
                    if (i==frm.elements.length-1) 
                        i=-1;
                    break 
                }
            /*ACA ESTA EL CAMBIO*/
            if (frm.elements[i+1].disabled ==true )    
                tabular(e,frm.elements[i+1]);
            else frm.elements[i+1].focus();
            return false;
        }  

function Foc()
 {
 document.getElementById("fecnac").focus();
 }
</script>
<style>

.cajaCentro {
	font-family: Tahoma, Verdana, "Trebuchet MS";
	font-size: 10x;
	color: #666666;
	float: none;
	text-align: center;
	padding-top: 5px;
	padding-right: 2px;
	padding-bottom: 5px;
	padding-left: 8px;
}

.stl_anchoCompleto3 {
	float: left;
	width: 360px;
	background: #FAFAFA;
	border: 1px #F1F1F1 solid;
	border-bottom: 0px;
	}
.mensajes {
	font-family: Verdana, Geneva, sans-serif;
	font-size: 12px;
	font-style: normal;
	color: #F00;
}
</style>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body background="img/fondo.jpg" leftmargin="0" topmargin="0" marginheight="0" marginwidth="0" style="font-family:Tahoma, Verdana, "Trebuchet MS"" onLoad="recibo.cedula.focus()">
<!-- Validar cédula del empleado -->
<?php
	$mensaje = "";		// Mensajes
	$activo  = false;
	
	switch(true){
	case (isset($_POST["buscar"])) :
		// Declarar variables
		$cedula = $_POST["cedula"];
			
		$numreg = buscar_cedula($cedula);
		if($numreg==0)
			$mensaje = "La cédula suministrada no está registrada, verifique";
		else {
			$activo = true;
			$_SESSION["ss_cedula"] = $cedula;
		}
		break;
			
	case (isset($_POST["recibo"])) :
		$cedula = $_SESSION["ss_cedula"];
		$fecnac = $_POST["fecnac"];
		$codnom = $_POST["codnom"];
		$lapso  = $_POST["lapso"];

		$_SESSION["ss_lapso"]  = $lapso;
		$_SESSION["ss_recibo"] = "";
		$_SESSION["ss_empresa"] = $empresa;

			
		$numreg = buscar_recibo($cedula,$fecnac,$codnom,$lapso,$empresa);		
		if($numreg==0)
			$mensaje = "Los datos suministrados no son correctos, verifique";
		else {
		
			echo "<script>window.open('Recibo.php')</script>";
			$cedula = "";
			$fecnac = "";
			$codnom = "";
			$lapso  = "";	
			$empresa= "";
		
	}
		break;
		
	case (isset($_POST["otra"])) :
		$fecnac = "";
		$codnom = "";
		$lapso  = "";	
		break;
	}
?>
<br>
<table width="60%" border="0" align="center" cellpadding="0" cellspacing="0">
  <TBODY>
  <tr>
    <td colspan="3" align="center"><img src="img/top1.jpg" /></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><br><img src="img/top.gif" width="768"></td>
  </tr>
  <tr>
    <td width="5" height="450" align="left" background="img/border_left.jpg"></td>
    <td width="700" align="center" bgcolor="#FFFFFF">
	
    <!--  Inicio de contenido  -->
	<table border="0" align="center">
    	<tr>
       		<td align="center"><font color="#000080" size="+1"><b>CONSULTA DE RECIBOS DE PAGO </b></font></td>
    	</tr> 
    	<tr>
	   	 	<td align="center"><font size="2" color="#999999" style="font-size:10px; font-family:Tahoma, Verdana, 'Trebuchet MS'">Fuente: Sistema Nomina</font></td>
	    </tr>
  	</table><br /><br />

    <form action="index.php" method="post" autocomplete="off" name="recibo">
      <table width="60%" border="0" align="center" cellpadding="2" cellspacing="0">
      <tr bgcolor="#F2F2F2">
        <td width="44%" align="right" style="font-size:12px; font-family:Tahoma, Verdana, 'Trebuchet MS'; font-weight:bold">Cédula:&nbsp;&nbsp;</td>
        <td width="56%" align="left" style="font-size:12px; font-family:Tahoma, Verdana, 'Trebuchet MS'; color:#006600; font-weight:bolder">
        	<?php
				If ($activo)
					echo $_SESSION["ss_cedula"];
				else
					echo '<input name="cedula" type="text" maxlength="8" size="18" value="" style="font-size:12px; font-family:Tahoma, Verdana, Trebuchet MS" title="Ej: 12345678" placeholder="Inserta tu Cédula"/>';
			?>

        </td>
      </tr>
      <tr bgcolor="#F2F2F2">
        <td align="right" style="font-size:12px; font-family:Tahoma, Verdana, 'Trebuchet MS'; font-weight:bold">Fecha de Nacimiento:&nbsp;&nbsp;</td>
        <td align="left">
       		<span id="spryfecnac">
				     		<input id="fecnac" name="fecnac" value="" type="text" size="13" maxlength="8"<?php If (!$activo) echo 'disabled="disabled"' ?> onkeypress="return validarnumeros(event); tabular(event,this);" autofocus placeholder="DD/MM/AAAA"/>
    		    <font color="#666666" style="font-size:10px; font-family:Tahoma, Verdana, 'Trebuchet MS'"> Ej: DD/MM/AAAA</font>
				<!-- <span class="textfieldInvalidFormatMsg">Formato no válido</span>-->
            </span>
        </td>
      </tr>
      <tr bgcolor="#F2F2F2">
        <td align="right" style="font-size:12px; font-family:Tahoma, Verdana, 'Trebuchet MS'; font-weight:bold">Contrase&ntilde;a:&nbsp;&nbsp;</td>
        <td align="left"><input type="password" name="codnom" value="" maxlength="4" size="13" onkeypress="return tabular(event,this);" <?php If (!$activo) echo 'disabled="disabled"' ?> />
          <font color="#990000" style="font-size:10px; font-family:Tahoma, Verdana, 'Trebuchet MS'"><b>(4 dígitos)</b></font></td>
      </tr>
      <tr bgcolor="#F2F2F2">
        <td align="right" style="font-size:12px; font-family:Tahoma, Verdana, 'Trebuchet MS'; font-weight:bold">Mes:&nbsp;&nbsp;</td>
        <td align="left">
        	<?php if ($activo)
				cargar_meses($cedula);
			?>
		</td>
      </tr>
      <tr><td colspan="2" align="center">&nbsp;</td></tr>
      <tr>
        <td colspan="2" align="center">
			<?php 
				If ($activo){ 
					echo '<input name="recibo" type="submit" class="frm_campo" value="Consultar Recibo" style="font-size:12px; font-family:Tahoma, Verdana, Trebuchet MS">&nbsp;&nbsp;';
					echo '<input name="otra" type="submit" class="frm_campo" value="Otra Cédula" style="font-size:12px; font-family:Tahoma, Verdana, Trebuchet MS" />&nbsp;&nbsp;';
				} else
		        	echo '<input name="buscar" type="submit" class="frm_campo" value="Buscar Cédula" style="font-size:12px; font-family:Tahoma, Verdana, Trebuchet MS" onkeyup="cambio()"/>&nbsp;&nbsp;';			
			?>
        </td>
      </tr>
      <tr><td colspan="2" align="justify" style="font-size:12px; font-family:Tahoma, Verdana, Trebuchet MS; line-height:20px"><br>
        <strong>Recuerde:</strong> Este Documento será válido para realizar trámites legales, si esta debidamente sellado por la Empresa.</td>
      </tr>
      <tr>
        <td colspan="2" align="center">
		 	<!-- Mensajes -->
			<strong class="mensajes"><?php echo $mensaje; ?></strong>
        </td>
      </tr>
      </table>
    </form>    </td>
    <td width="7" height="450" align="right" background="img/border_right.jpg">&nbsp;</td>
  </tr>
  <tr>
    <td height="7" colspan="3" align="left"><div align="center"><img src="img/down.gif" width="768"></div></td>
  </tr>
  <tr>
    <td height="30" colspan="3" align="center" style="font-size:10px; font-family:Tahoma, Verdana, 'Trebuchet MS'"><strong>Creado por:</strong> Educonsult C.A</td>
  </tr>
</table>

<script type="text/javascript">
	//var sprytextfield1 = new Spry.Widget.ValidationTextField("spryfecnac", "date", {format:"dd/mm/yyyy", isRequired:false});
</script>
</tbody>
</body>
</html>
