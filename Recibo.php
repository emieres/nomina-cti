<?php
			session_start();

   
		$data = $_SESSION["ss_recibo"];
		$data  = utf8_decode(str_replace("&Ntilde;","Ñ", $_SESSION["ss_recibo"]));
		$data1 = str_replace("","",$data);

		$recibo_nombre=	$_SESSION["ss_lapso"];

			 switch($_SESSION["ss_empresa"]){
				 case 1: 
					 $imag = "img/iutepi.jpg";
					 break;
				
				 case 2: 
					 $imag = "img/litin.jpg";
					 break;

				 case 3: 
					 $imag = "img/cti.jpg";
					 break;
				
				 case 4: 
					  $imag = "img/educonsult.jpg";
					 break;
			
				}

					require('pdf/fpdf.php');
					
					$archivo_salida=$archivo;
					
					$pdf = new FPDF ('P','mm','letter');
					$pdf->SetTopMargin(25);

					$cadena = $data1;
					$cadena_buscada   = (chr(12));

					while (true) 
					{
						$posicion_coincidencia = strpos($cadena, $cadena_buscada);
	
							if (($posicion_coincidencia == 0) || empty ($cadena))
					          {
							  break;
								}
					    
								$memo2= substr($cadena,0,$posicion_coincidencia - 1); 
											
							$pdf->AddPage();
							$pdf->SetFont('Courier','',10);
							$pdf->SetLeftMargin(25);
										 switch($_SESSION["ss_empresa"])
										 {
											 case 1: 
												 $pdf->Image($imag,25,15,50);
												 break;
											
											 case 2: 
												 $pdf->Image($imag,25,5,17);
												 break;
							
											 case 3: 
												 $pdf->Image($imag,25,5,20);
												 break;
											
											 case 4: 
													$pdf->Image($imag,25,5,50);
												 break;
										
											}

							$pdf->SetAutoPageBreak(true); 
							$pdf->multiCell(183,4,"\n".$memo2."\n");
							$cadena = substr($cadena,$posicion_coincidencia  + 1); 
							
							}
							
$pdf->Output("Recibo ".$recibo_nombre.".pdf",'I');
// Finalmente, destruir la sesión.
session_destroy();

?>