<?php

//require_once "../../../controladores/asistencia.controlador.php";
//require_once "../../../modelos/asistencia.modelo.php";

require_once "../../..//controladores/adminpreguntas.controlador.php";
require_once "../../../modelos/adminpreguntas.modelo.php";

//require_once "../../../controladores/departamentos.controlador.php";
//require_once "../../../modelos/departamentos.modelo.php";

extract($_POST);
$Clave_PreguntaEspecifica = $_GET['idPreguntaEspecifica'];
//$Direccion = $_POST['direccion'];

//REQUERIMOS LA CLASE TCPDF

require_once 'tcpdf_include.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP-10);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->startPageGroup();
$pdf->AddPage();


// ---------------------------------------------------------
$item  = null;
$valor = null;

$Key_Acceso="%D4r1s@0Fm4y0r*%";
function decrypt($data,$key)
{
    list($encrypted_data, $cifrado) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $cifrado);
}
$id_clave=decrypt($Clave_PreguntaEspecifica,$Key_Acceso);

$preguntas = Controladorpreguntas::ctrMostrarPreguntaEspecificaReporte($id_clave,$item);

foreach ($preguntas as $key => $value) {
    $valorPersonal = $value["Nombre_DireccionGeneral"];
    $TipoPregunta = $value["Nombre_Tema"];
    $Pregunta = $value["Pregunta"];
    $RespuestaPre = $value["Respuesta"];
    $Justificacion = $value["Justificacion"];

    //$imagenes = array('uno.jpg');

    //$cuantas = count($imagenes);
    //$aleatorio = rand(0, $cuantas - 1);

// ---------------------------------------------------------

    $bloque1 = <<<EOF

	<table>

	

			<img style="width:210px; height:80px;" src="images/uno.jpg">	

	</table>

EOF;

    $pdf->writeHTML($bloque1, false, false, false, false, '');

    $bloque2 = <<<EOF

     <br>

	<table border="0" bordercolor="#000000" align="center" cellspacing="0">

     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 19px" align="justify"><b>$Pregunta</b></td>
     
     </tr><br>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 19px" align="justify">$RespuestaPre</td>
     
     </tr>
     
     <br>
     <tr>
         <td class="row" style="color:black;margin-left: 90px;font-size: 19px" align="justify">$Justificacion</td>
     
     </tr>
     
     <br>
       

	</table>

EOF;

    $pdf->writeHTML($bloque2, false, false, false, false, '');
}

// ---------------------------------------------------------

// ---------------------------------------------------------

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO

$pdf->Output('Pregunta.pdf');
