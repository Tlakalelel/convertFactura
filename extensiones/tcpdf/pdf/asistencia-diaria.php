<?php

//require_once "../../../controladores/asistencia.controlador.php";
//require_once "../../../modelos/asistencia.modelo.php";

require_once "../../..//controladores/adminpreguntas.controlador.php";
require_once "../../../modelos/adminpreguntas.modelo.php";



//require_once "../../../controladores/departamentos.controlador.php";
//require_once "../../../modelos/departamentos.modelo.php";

/*extract($_POST);
$Tema = $_POST['tema'];
$Direccion = $_POST['direccion'];*/

//REQUERIMOS LA CLASE TCPDF

require_once 'tcpdf_include.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP-20);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->startPageGroup();
$pdf->AddPage();



// ---------------------------------------------------------
$item  = null;
$valor = null;

$preguntas = Controladorpreguntas::ctrMostrarPreguntasTarjetasReporte($item);
$direcciones = Controladorpreguntas::ctrObtenerDireccion($item);
//function GeneraIndice($preguntas);



foreach ($preguntas as $key => $value) {
    $valorPersonal = $value["Nombre_DireccionGeneral"];
    //$TipoPregunta = $value["Nombre_Tema"];
    $Pregunta = $value["Pregunta"];
    $RespuestaPre = $value["Respuesta"];
   // $Justificacion = $value["Justificacion"];
    
   // $imagenes = array('uno.jpg', 'dos.jpg','tres.jpg','cuatro.jpg');

   // $cuantas = count($imagenes);
   // $aleatorio = rand(0, $cuantas - 1);
}
// ---------------------------------------------------------

    $bloque1 = <<<EOF
	

			<img style="width:210px; height:80px;" src="images/uno.jpg">	

EOF;

    $pdf->writeHTML($bloque1, false, false, false, false, '');

    $bloque2 = <<<EOF
    <br>
    <br>
	<table border="0" bordercolor="white" align="center" cellspacing="0">

     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="justify"><b>$Pregunta</b></td>
     
     </tr><br>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 18px" align="justify">$RespuestaPre</td>
     
     </tr>

    
    
	</table>
   
EOF;
//$pdf->writeHTML($bloque2, false, false, false, false, '');


///----------------------------------INICIO DE TABLA DE CONTENIDO-------------------------------///

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP-20);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set font
$pdf->SetFont('times', '', 20);

// add a page
$pdf->AddPage();


// set a bookmark for the current position

//$pdf->Bookmark($valorPersonal, 0, 0, '', 'B', array(0,64,128));
// print a line using Cell()
//$pdf->Cell(0, 10, $valorPersonal, 0, 1, 'C');

foreach($direcciones as $key =>$value){
$direcc=$value["Nombre_DireccionGeneral"];

    $pdf->SetFillColor(255, 255, 255);
    $pdf->Bookmark($direcc, 0, 0, '', 'B', array(0,64,128));

$preIndice = Controladorpreguntas::ctrPreguntasIndice($direcc,$item);

  foreach ($preIndice as $key => $value) {
  // $valorPersonal = $value["Nombre_DireccionGeneral"];
    $Pregunta = $value["Pregunta"];
    $Respuesta=$value["Respuesta"];
    $pdf->SetFillColor(255, 255, 255);
    $pdf->Bookmark($Pregunta, 1, 0, '', '', array(128,0,0));
    
    //$pdf->Bookmark('Sub-Paragraph 1.2.1', 2, 0, '', 'I', array(0,128,0));
    $pdf->Ln(50);
    $pdf->MultiCell(191, 1, $Pregunta, 0, 'J', true, 0, 18, 10, true, 0, true, false, 2, 'T', 0);
    ///DESCOMENTAR AL SUBIR AL HOSTING
    //$pdf->MultiCell(191, 5, $Respuesta,0, 'J', true, 0, 18, 31, true, 0, true, false, 10, 'T', 0);
    
    $pdf->Ln(62);
    $pdf->SetY(-90);
    $pdf->Cell(0, 0, 'Página '.$pdf->getAliasNumPage().'/'.$pdf->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    $pdf->AddPage();
}
}
$pdf->addTOCPage();
// write the TOC title

$pdf->SetFont('times', 'B', 16);
$pdf->MultiCell(0, 0, 'Índice de Contenido', 0, 'C', 0, 1, '', '', true, 0);
$pdf->Ln();

$pdf->SetFont('dejavusans', '', 12);

// add a simple Table Of Content at first page
// (check the example n. 59 for the HTML version)
$pdf->addTOC(1, 'courier', '.', 'INDEX', '', array(128,0,0));


// end of TOC page
$pdf->endTOCPage();
///----------------------------------FIN DE TABLA DE CONTENIDO-------------------------------///


//SALIDA DEL ARCHIVO

$pdf->Output('asistencia.pdf');


