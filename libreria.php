<?php
	// Buscar cedula
	function buscar_cedula($cedula){
		$dsn = "nomina"; 
		$cid = odbc_connect($dsn, "", ""); 
		
		$result = odbc_exec($cid, "SELECT * from login WHERE cedula='$cedula'") or die("<p>".odbc_errormsg());
		$numreg = odbc_fetch_array($result);
		return $numreg;
	}
	
	// Buscar recibo
	function buscar_recibo($cedula,$fecnac,$codnom,$lapso,$empresa){
		$dsn = "nomina"; 
		$cid = odbc_connect($dsn, "", ""); 
		
		$result = odbc_exec($cid, "SELECT * FROM login WHERE cedula='$cedula' AND fecnac='$fecnac' AND codnom='$codnom'") or die("<p>".odbc_errormsg());
		$numreg = odbc_fetch_array($result);
		if ($numreg <> 0){
			$result = odbc_exec($cid, "SELECT * FROM nomina WHERE cedula='$cedula' AND lapso='$lapso'") or die("<p>".odbc_errormsg());			
			$numreg = odbc_fetch_array($result);
			$_SESSION["ss_recibo"] = $numreg["recibo"];
			$_SESSION["ss_empresa"] = $numreg["empresa"];
			$_SESSION["ss_lapso"] = $numreg["lapso"];
					}
		return $numreg;
	}
	
	// Cargar Select de Meses
	function cargar_meses($cedula){
		$dsn = "nomina"; 
		$cid = odbc_connect($dsn, "", ""); 

		$result = odbc_exec($cid, "SELECT * from nomina WHERE cedula='$cedula' ORDER BY lapso DESC") or die("<p>".odbc_errormsg());

		echo '<select size="1" name="lapso">';
		
		while( $row = odbc_fetch_array($result)) {
			echo '<option value="'.$row["lapso"].'">'.mes_year($row["lapso"]).'</option>';
			}
		echo '</select>';
	}

	// Formato de fecha para el combo
	function mes_year($lapso){		
		$fecha= substr($lapso,0,4);
		$mes= (int)substr($lapso,4,2);
		switch($mes){
			case 1:
				$result= "Enero ".$fecha;
				break;
			case 2:
				$result= "Febrero ".$fecha;
				break;
			case 3:
				$result= "Marzo ".$fecha;
				break;
			case 4:
				$result= "Abril ".$fecha;
				break;
			case 5:
				$result= "Mayo ".$fecha;
				break;
			case 6:
				$result= "Junio ".$fecha;
				break;
			case 7:
				$result= "Julio ".$fecha;
				break;
			case 8:
				$result= "Agosto ".$fecha;
				break;
			case 9:
				$result= "Septiembre ".$fecha;
				break;
			case 10:
				$result= "Octubre ".$fecha;
				break;
			case 11:
				$result= "Noviembre ".$fecha;
				break;
			case 12:
				$result= "Diciembre ".$fecha;
				break;
		}
		return $result;
	}
	
?>
