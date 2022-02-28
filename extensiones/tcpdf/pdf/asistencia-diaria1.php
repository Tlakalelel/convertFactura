<?php

//require_once "../../../controladores/asistencia.controlador.php";
//require_once "../../../modelos/asistencia.modelo.php";

require_once "../../..//controladores/adminpreguntas.controlador.php";
require_once "../../../modelos/adminpreguntas.modelo.php";

//require_once "../../../controladores/departamentos.controlador.php";
//require_once "../../../modelos/departamentos.modelo.php";

extract($_POST);
$Tema = $_POST['tema'];
$Direccion = $_POST['direccion'];

//REQUERIMOS LA CLASE TCPDF

require_once 'tcpdf_include.php';



$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP-10);
$pdf->SetPrintHeader(false);
$pdf->SetPrintFooter(false);
$pdf->startPageGroup();
$pdf->AddPage();

//---------------------------PAGINACIÓN
 
// ---------------------------------------------------------
$item  = null;
$valor = null;

$preguntas = Controladorpreguntas::ctrMostrarPreguntasReporte($Tema,$Direccion,$item);

foreach ($preguntas as $key => $value) {
    $valorPersonal = $value["Nombre_DireccionGeneral"];
    $TipoPregunta = $value["Nombre_Tema"];
    $Pregunta = $value["Pregunta"];
    $RespuestaPre = $value["Respuesta"];
    $Justificacion = $value["Justificacion"];

    $imagenes = array('uno.jpg', 'dos.jpg','tres.jpg');

    $cuantas = count($imagenes);
    $aleatorio = rand(0, $cuantas - 1);

// ---------------------------------------------------------

    $bloque1 = <<<EOF

	<table>

	

			<img style="width:1100px; height:173px;" src="images/$imagenes[$aleatorio]">	
			<tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="left"></td>
     
            </tr>

	</table>

EOF;

    $pdf->writeHTML($bloque1, false, false, false, false, '');

    $bloque2 = <<<EOF

     <br>

	<table border="0" bordercolor="#000000" align="center" cellspacing="0">

	  <tr>
         <td class="row" style="color:#1e7e34;margin-left: 90px;font-size: 20px" align="left"><b>$valorPersonal</b></td>
     
     </tr>
     <tr>
         <td class="row" style="color:#6610f2;margin-left: 90px;font-size: 17px" align="left"><b>$TipoPregunta</b></td>
     
     </tr>
     <br>
     <br>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="justify"><b>$Pregunta</b></td>
     
     </tr><br>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="justify">$RespuestaPre</td>
     
     </tr>
     
     
     <br>
     
     
     <br>
     <br>
     <br>
     <br>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="left"></td>
     
     </tr>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="left"></td>
     
      </tr>
      
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="left"></td>
     
      </tr>
      
     
     <br>
     <br>
   
 
     

    </table>
    
    <br pagebreak="true"/>
EOF;

    $pdf->writeHTML($bloque2, false, false, false, false, '');

    $pdf->SetY(-93);
    // Set font
    $pdf->SetFont('helvetica', 'I', 10);
    // Page number
    $pdf->Cell(0, 10, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    
}

// ---------------------------------------------------------

// ---------------------------------------------------------

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO

$pdf->Output('asistencia.pdf');


