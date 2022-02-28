<?php

require_once "../../../controladores/reporteactividad.controlador.php";
require_once "../../../modelos/reporteactividades.modelo.php";


extract($_POST);

if (isset($_GET['historyreport'])&& isset($_GET['keyDir'])) {
 
$keyReporteView=$_GET['historyreport'];
$keyReporteDir=$_GET['keyDir'];

//REQUERIMOS LA CLASE TCPDF

require_once 'tcpdf_include.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetTitle('Reporte Dirección');

//$pdf->setPageOrientation('L');
//$pdf->SetFont('Graphik Medium', '', 14, '', true);
//$pdf->SetFont('verdana', '', 12);
$pdf->SetTopMargin(3);
$pdf->SetLeftMargin(10);
$pdf->SetRightMargin(10);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->startPageGroup();
$pdf->AddPage('P',array(215,215));

$DatosReporteView = ControladorActividad::ControllerObtenerDatosReporteViewDownload($keyReporteDir);

foreach ($DatosReporteView as $key => $value) {

            $Direccion=$value["Nombre_DireccionGeneral"];

            //Fecha de Inicio del Reporte
            
            $FechaIni=$value["Fecha_Inicio"];
            $ExtraFechaIni=strtotime($FechaIni);
            $diaInicio = date("d", $ExtraFechaIni);
            $AñoInicio = date("Y", $ExtraFechaIni);

          //Fecha de Finalizacion del Reporte
           
            $FechaFin=$value["Fecha_Final"];
            $ExtraFechaFin=strtotime($FechaFin);
            $diaFinal = date("d", $ExtraFechaFin);
            $AñoFinal = date("Y", $ExtraFechaFin);

          //Extras

            $ConvertirMesInicio  =date("m",$ExtraFechaIni);
            $ConvertirMesFinal  =date("m",$ExtraFechaFin);
            

switch($ConvertirMesInicio)
{   
    case 01:
    $mesinicio = "ENERO";
    break;
    
    case 02:
    $mesinicio = "FEBRERO";
    break;

    case 03:
    $mesinicio = "MARZO";
    break;

    case 04:
    $mesinicio = "ABRIL";
    break;

    case 05:
    $mesinicio = "MAYO";
    break;

    case 06:
    $mesinicio = "JUNIO";
    break;

    case 07:
    $mesinicio = "JULIO";
    break;

    case '08':
    $mesinicio = "AGOSTO";
    break;

    case '09':
    $mesinicio = "SEPTIEMBRE";
    break;

    case '10':
    $mesinicio = "OCTUBRE";
    break;

    case '11':
    $mesinicio = "NOVIEMBRE";
    break;

    case '12':
    $mesinicio = "DICIEMBRE";
    break;

    //...
}

switch($ConvertirMesFinal)
{   
    case 01:
    $mesfinal = "ENERO";
    break;
    
    case 02:
    $mesfinal = "FEBRERO";
    break;

    case 03:
    $mesfinal = "MARZO";
    break;

    case 04:
    $mesfinal = "ABRIL";
    break;

    case 05:
    $mesfinal = "MAYO";
    break;

    case 06:
    $mesfinal = "JUNIO";
    break;

    case 07:
    $mesfinal = "JULIO";
    break;

    case '08':
    $mesfinal = "AGOSTO";
    break;

    case '09':
    $mesfinal = "SEPTIEMBRE";
    break;

    case '10':
    $mesfinal = "OCTUBRE";
    break;

    case '11':
    $mesfinal = "NOVIEMBRE";
    break;

    case '12':
    $mesfinal = "DICIEMBRE";
    break;

    //...
}

//Validar el Mes

if ($mesinicio==$mesfinal) {

  $bloque1 = <<<EOF
    <style>
    
    @font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
    #medium{
    font-family: "Graphik Medium";
    }
    .uppercase {
        text-transform: uppercase;
    }
    
     </style>
    
  <table>
  <tr class="uppercase">
    <td class="row uppercase" style="color:black;margin-left: 90px;font-size: 11px" align="justify" id="medium"><b>REPORTE SEMANAL DE ACTIVIDADES<br></b>
           $diaInicio AL $diaFinal DE $mesfinal DE $AñoFinal
            <div class="uppercase">AREA: $Direccion</div>
    </td>
         <td class="row" style="" align="right"><b><img style="width:188px; height:50px;" src="images/uno.jpg"></b></td>
     
     </tr>
  
</table>
      

EOF;
  
}else{ 
   
   $bloque1 = <<<EOF
    <style>
    
    @font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
    #medium{
    font-family: "Graphik Medium";
    }
    .uppercase {
        text-transform: uppercase;
    }
    
     </style>
    
  <table>
  <tr class="uppercase">
     <td class="row uppercase" style="color:black;margin-left: 90px;font-size: 11px" align="justify" id="medium"><b>REPORTE SEMANAL DE ACTIVIDADES<br></b>$diaInicio DE $mesinicio DE $AñoInicio AL $diaFinal DE $mesfinal DE $AñoFinal
            <div class="uppercase">AREA: $Direccion</div>
     </td>
        <td class="row" style="" align="right">
           <b><img style="width:188px; height:50px;" src="images/uno.jpg"></b>
        </td>
     
  </tr>
  
  </table>
      

EOF;


}

$pdf->writeHTML($bloque1, false, false, false, false, '');

            
}
$pdf->Ln(3);

$bloque2 = <<<EOF
    <style>
    
    @font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
    #medium{
    font-family: "Graphik Medium";
    }
    td {
        border: 0.3px solid #171616;
        /*background-color: #ffffee;*/
        color:#171616;
    }
     </style>
    
  <table>
  <tr>
  <td width="155" id="medium" align="center" bgcolor="#DCDCDC" rowspan="2"><b>TEMA</b></td>
  <td width="81" id="medium" align="center" bgcolor="#DCDCDC" rowspan="2"><b>CANTIDAD</b></td>
  <td width="157" id="medium" align="center" bgcolor="#DCDCDC"><b>ACTIVIDAD</b></td>
  <td width="157" id="medium" align="center" bgcolor="#DCDCDC" rowspan="2"> <b>INSTITUCIONES<br> INVOLUCRADAS</b></td>
 </tr>
 
 <tr>
<td align="center" id="medium" bgcolor="#E7E5E5"><b>DESCRIPCIÓN DE LA ACTIVIDAD</b></td>
</tr>
  
</table>
      

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$actividadesreporte =ControladorActividad::ControllerObtenerReporteCompleto($keyReporteView);

foreach ($actividadesreporte as $key => $value) {
    // $valorPersonal = $value["Nombre_DireccionGeneral"];
    //$TipoPregunta = $value["Nombre_Tema"];
    //$Direcc=$value["Nombre_DireccionGeneral"];
    $Tema = nl2br($value["Tema"]);
    $Numero = nl2br($value["Numero"]);
    $Activity = nl2br($value["Actividad"]);
    $Insti = nl2br($value["Instituciones_Involucradas"]);
    

    // $imagenes = array('uno.jpg', 'dos.jpg','tres.jpg','cuatro.jpg');

    // $cuantas = count($imagenes);
    // $aleatorio = rand(0, $cuantas - 1);

// ---------------------------------------------------------


    $bloque3 = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
@font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
@font-face {
  font-family: "Graphik Regular";
  src: url("../fonts/Graphik-Regular.otf");
}

    h1 {
        color: navy;
        font-family: times;
        font-size: 24pt;
        text-decoration: underline;
    }
    p.first {
        color: #003300;
        font-family: helvetica;
        font-size: 12pt;
    }
    p.first span {
        color: #006600;
        font-style: italic;
    }
    p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 12pt;
        text-align: justify;
    }
    p#second > span {
        background-color: #FFFFAA;
    }
    table.first {
        color: #003300;
        font-family: helvetica;
        font-size: 10pt;
       /* border-left: 3px solid red;*/
        /*border-right: 3px solid #FF00FF;*/
        /*border-top: 3px solid green;*/
        /*border-bottom: 3px solid blue;*/
        /*background-color: #ccffcc;*/
    }
    td {
        border: 0.3px solid #171616;
        /*background-color: #ffffee;*/
        color:#171616;
    }
    #regular{
    font-family: "Graphik Regular";
    }
     #medium{
    font-family: "Graphik Medium";
    }
    /*td.second {
        border: 2px dashed green;
    }*/
    div.test {
        color: #CC0000;
        background-color: #FFFF66;
        font-family: helvetica;
        font-size: 10pt;
        border-style: solid solid solid solid;
        border-width: 2px 2px 2px 2px;
        border-color: green #FF00FF blue red;
        text-align: center;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
    .topmedio{
    margin-top:30px;
  }
</style>
<table class="first" cellpadding="3" cellspacing="">
 <tr>
  <td width="155" id="regular" align="justify">$Tema</td>
  <td width="81" id="regular" class="second topmedio" align="center">$Numero</td>
  <td width="157" id="regular" align="justify">$Activity</td>
  <td width="157" id="regular" align="left">$Insti
</td>
 </tr>
 
</table>

EOF;

    $pdf->writeHTML($bloque3, false, false, false, false, '');

   // $pdf->AddPage('L','Letter');
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    //$pdf->Ln(38);
}

//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------

// ---------------------------------------------------------

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO
//$pdf->lastPage();

$pdf->Output('Reporte-Semanal-Secretaria.pdf','I');


}

if (isset($_GET['download']) && isset($_GET['keyDir'])) {

$keyReporteDown=$_GET['download'];
$keyReporteDir=$_GET['keyDir'];

//REQUERIMOS LA CLASE TCPDF

require_once 'tcpdf_include.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetTitle('Reporte Dirección');

//$pdf->setPageOrientation('L');
//$pdf->SetFont('Graphik Medium', '', 14, '', true);
//$pdf->SetFont('verdana', '', 12);
$pdf->SetTopMargin(3);
$pdf->SetLeftMargin(11);
$pdf->SetRightMargin(11);
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->startPageGroup();
$pdf->AddPage('P',array(215,215));

$DatosReporteView = ControladorActividad::ControllerObtenerDatosReporteViewDownload($keyReporteDir);

foreach ($DatosReporteView as $key => $value) {

  $Direccion=$value["Nombre_DireccionGeneral"];

            //Fecha de Inicio del Reporte
            
            $FechaIni=$value["Fecha_Inicio"];
            $ExtraFechaIni=strtotime($FechaIni);
            $diaInicio = date("d", $ExtraFechaIni);
            $AñoInicio = date("Y", $ExtraFechaIni);

          //Fecha de Finalizacion del Reporte
           
            $FechaFin=$value["Fecha_Final"];
            $ExtraFechaFin=strtotime($FechaFin);
            $diaFinal = date("d", $ExtraFechaFin);
            $AñoFinal = date("Y", $ExtraFechaFin);

          //Extras

            $ConvertirMesInicio  =date("m",$ExtraFechaIni);
            $ConvertirMesFinal  =date("m",$ExtraFechaFin);
            

switch($ConvertirMesInicio)
{   
    case 01:
    $mesinicio = "ENERO";
    break;
    
    case 02:
    $mesinicio = "FEBRERO";
    break;

    case 03:
    $mesinicio = "MARZO";
    break;

    case 04:
    $mesinicio = "ABRIL";
    break;

    case 05:
    $mesinicio = "MAYO";
    break;

    case 06:
    $mesinicio = "JUNIO";
    break;

    case 07:
    $mesinicio = "JULIO";
    break;

    case '08':
    $mesinicio = "AGOSTO";
    break;

    case '09':
    $mesinicio = "SEPTIEMBRE";
    break;

    case '10':
    $mesinicio = "OCTUBRE";
    break;

    case '11':
    $mesinicio = "NOVIEMBRE";
    break;

    case '12':
    $mesinicio = "DICIEMBRE";
    break;

    //...
}

switch($ConvertirMesFinal)
{   
    case 01:
    $mesfinal = "ENERO";
    break;
    
    case 02:
    $mesfinal = "FEBRERO";
    break;

    case 03:
    $mesfinal = "MARZO";
    break;

    case 04:
    $mesfinal = "ABRIL";
    break;

    case 05:
    $mesfinal = "MAYO";
    break;

    case 06:
    $mesfinal = "JUNIO";
    break;

    case 07:
    $mesfinal = "JULIO";
    break;

    case '08':
    $mesfinal = "AGOSTO";
    break;

    case '09':
    $mesfinal = "SEPTIEMBRE";
    break;

    case '10':
    $mesfinal = "OCTUBRE";
    break;

    case '11':
    $mesfinal = "NOVIEMBRE";
    break;

    case '12':
    $mesfinal = "DICIEMBRE";
    break;

    //...
}

//Validar el Mes

if ($mesinicio==$mesfinal) {

  $bloque1 = <<<EOF
    <style>
    
    @font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
    #medium{
    font-family: "Graphik Medium";
    }
    .uppercase {
        text-transform: uppercase;
    }
    
     </style>
    
  <table>
  <tr class="uppercase">
    <td class="row uppercase" style="color:black;margin-left: 90px;font-size: 11px" align="justify" id="medium"><b>REPORTE SEMANAL DE ACTIVIDADES<br></b>
           $diaInicio AL $diaFinal DE $mesfinal DE $AñoFinal
            <div class="uppercase">AREA: $Direccion</div>
    </td>
         <td class="row" style="" align="right"><b><img style="width:188px; height:50px;" src="images/uno.jpg"></b></td>
     
     </tr>
  
</table>
      

EOF;
  
}else{ 
   
   $bloque1 = <<<EOF
    <style>
    
    @font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
    #medium{
    font-family: "Graphik Medium";
    }
    .uppercase {
        text-transform: uppercase;
    }
    
     </style>
    
  <table>
  <tr class="uppercase">
     <td class="row uppercase" style="color:black;margin-left: 90px;font-size: 11px" align="justify" id="medium"><b>REPORTE SEMANAL DE ACTIVIDADES<br></b>$diaInicio DE $mesinicio DE $AñoInicio AL $diaFinal DE $mesfinal DE $AñoFinal
            <div class="uppercase">AREA: $Direccion</div>
     </td>
        <td class="row" style="" align="right">
           <b><img style="width:188px; height:50px;" src="images/uno.jpg"></b>
        </td>
     
  </tr>
  
  </table>
      

EOF;


}

$pdf->writeHTML($bloque1, false, false, false, false, '');

            
}
$pdf->Ln(3);

$bloque2 = <<<EOF
    <style>
    
    @font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
    #medium{
    font-family: "Graphik Medium";
    }
    td {
        border: 0.3px solid #171616;
        /*background-color: #ffffee;*/
        color:#171616;
    }
     </style>
    
  <table>
  <tr>
  <td width="155" id="medium" align="center" bgcolor="#DCDCDC" rowspan="2"><b>TEMA</b></td>
  <td width="81" id="medium" align="center" bgcolor="#DCDCDC" rowspan="2"><b>CANTIDAD</b></td>
  <td width="157" id="medium" align="center" bgcolor="#DCDCDC"><b>ACTIVIDAD</b></td>
  <td width="157" id="medium" align="center" bgcolor="#DCDCDC" rowspan="2"> <b>INSTITUCIONES<br> INVOLUCRADAS</b></td>
 </tr>
 
 <tr>
<td align="center" id="medium" bgcolor="#E7E5E5"><b>DESCRIPCIÓN DE LA ACTIVIDAD</b></td>
</tr>
  
</table>
      

EOF;
$pdf->writeHTML($bloque2, false, false, false, false, '');

// ---------------------------------------------------------

$actividadesreporte =ControladorActividad::ControllerObtenerReporteCompleto($keyReporteDown);

foreach ($actividadesreporte as $key => $value) {
    // $valorPersonal = $value["Nombre_DireccionGeneral"];
    //$TipoPregunta = $value["Nombre_Tema"];
    //$Direcc=$value["Nombre_DireccionGeneral"];
    $Tema = nl2br($value["Tema"]);
    $Numero = nl2br($value["Numero"]);
    $Activity = nl2br($value["Actividad"]);
    $Insti = nl2br($value["Instituciones_Involucradas"]);
    

    // $imagenes = array('uno.jpg', 'dos.jpg','tres.jpg','cuatro.jpg');

    // $cuantas = count($imagenes);
    // $aleatorio = rand(0, $cuantas - 1);

// ---------------------------------------------------------


    $bloque3 = <<<EOF
<!-- EXAMPLE OF CSS STYLE -->
<style>
@font-face {
  font-family: "Graphik Medium";
  src: url("../fonts/Graphik-Medium.otf");
}
@font-face {
  font-family: "Graphik Regular";
  src: url("../fonts/Graphik-Regular.otf");
}

    h1 {
        color: navy;
        font-family: times;
        font-size: 24pt;
        text-decoration: underline;
    }
    p.first {
        color: #003300;
        font-family: helvetica;
        font-size: 12pt;
    }
    p.first span {
        color: #006600;
        font-style: italic;
    }
    p#second {
        color: rgb(00,63,127);
        font-family: times;
        font-size: 12pt;
        text-align: justify;
    }
    p#second > span {
        background-color: #FFFFAA;
    }
    table.first {
        color: #003300;
        font-family: helvetica;
        font-size: 10pt;
       /* border-left: 3px solid red;*/
        /*border-right: 3px solid #FF00FF;*/
        /*border-top: 3px solid green;*/
        /*border-bottom: 3px solid blue;*/
        /*background-color: #ccffcc;*/
    }
    td {
        border: 0.3px solid #171616;
        /*background-color: #ffffee;*/
        color:#171616;
    }
    #regular{
    font-family: "Graphik Regular";
    }
     #medium{
    font-family: "Graphik Medium";
    }
    /*td.second {
        border: 2px dashed green;
    }*/
    div.test {
        color: #CC0000;
        background-color: #FFFF66;
        font-family: helvetica;
        font-size: 10pt;
        border-style: solid solid solid solid;
        border-width: 2px 2px 2px 2px;
        border-color: green #FF00FF blue red;
        text-align: center;
    }
    .lowercase {
        text-transform: lowercase;
    }
    .uppercase {
        text-transform: uppercase;
    }
    .capitalize {
        text-transform: capitalize;
    }
    .topmedio{
    margin-top:30px;
  }
</style>
<table class="first" cellpadding="3" cellspacing="">
 <tr>
  <td width="155" id="regular" align="justify">$Tema</td>
  <td width="81" id="regular" class="second topmedio" align="center">$Numero</td>
  <td width="157" id="regular" align="justify">$Activity</td>
  <td width="157" id="regular" align="left">$Insti
</td>
 </tr>
 
</table>

EOF;

    $pdf->writeHTML($bloque3, false, false, false, false, '');

   // $pdf->AddPage('L','Letter');
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
    //$pdf->Ln(38);
}

//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// ---------------------------------------------------------

// ---------------------------------------------------------

// ---------------------------------------------------------
//SALIDA DEL ARCHIVO
//$pdf->lastPage();

$pdf->Output('Reporte-Semanal-Secretaria.pdf','D');

}


