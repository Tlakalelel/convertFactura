<?php
require_once("vendor/autoload.php");
require_once "../../modelos/archivoEstatal.modelo.php";

$mes = $_GET['mes'];
$NombreFile = "Archivo Estatal " . $mes . ".xlsx";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$spreadsheet->getProperties()
    ->setCreator("System")
    ->setLastModifiedBy("Oficialia Mayor")
    ->setTitle("Archivo Estatal")
    ->setSubject("Reporte")
    ->setCategory("Reporte");

$spreadsheet->getDefaultStyle()->getFont()->setName('Graphik Regular')->setSize(10);

$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', '#')
    ->setCellValue('B1', 'Fecha')
    ->setCellValue('C1', 'Actividad')
    ->setCellValue('D1', 'Descripcion')
    ->setCellValue('E1', 'Cantidad')
    ->setCellValue('F1', 'Unidad de medida')
    ->setCellValue('G1', 'Área ejecutora')
    ->setCellValue('H1', 'Sujeto obligado')
    ->setCellValue('I1', 'Poder ejecutivo')
    ->setCellValue('J1', 'Poder legislativo')
    ->setCellValue('K1', 'Poder judicial')
    ->setCellValue('L1', 'Ayuntamientos')
    ->setCellValue('M1', 'Organismos autonomos')
    ->setCellValue('N1', 'Instituciones Sociales')
    ->setCellValue('O1', 'Otros sujetos')
    ->setCellValue('P1', 'Medio de atención')
    ->setCellValue('Q1', 'No. de beneficiarios');

$spreadsheet->getActiveSheet()->getStyle("A1:Q1")->getFont()->setBold(true);
$spreadsheet->getActiveSheet()->getStyle("A1:Q1")->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$resultado = Modeloarchivoestatal::mdlListarArchivos($mes);
$i = 2;
$key = 1;

foreach ($resultado as $row) {
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue("A$i", $key)
        ->setCellValue("B$i", $row['fecha'])
        ->setCellValue("C$i", $row['actividad'])
        ->setCellValue("D$i", $row['descripcion'])
        ->setCellValue("E$i", $row['cantidad'])
        ->setCellValue("F$i", $row['unidadMedida'])
        ->setCellValue("G$i", $row['areaEjecutora'])
        ->setCellValue("H$i", $row['sujetoObligado'])
        ->setCellValue("I$i", $row['poderEjecutivo'])
        ->setCellValue("J$i", $row['poderLegislativo'])
        ->setCellValue("K$i", $row['poderJudicial'])
        ->setCellValue("L$i", $row['ayuntamiento'])
        ->setCellValue("M$i", $row['organismosAuto'])
        ->setCellValue("N$i", $row['instSociales'])
        ->setCellValue("O$i", $row['otrosSujetos'])
        ->setCellValue("P$i", $row['medioAtencion'])
        ->setCellValue("Q$i", $row['noBeneficiarios']);
    $i++;
    $key++;
}

$spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('H')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('I')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('K')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('L')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('N')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('O')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('P')->setAutoSize(true);
$spreadsheet->getActiveSheet()->getColumnDimension('Q')->setAutoSize(true);

$spreadsheet->getActiveSheet()->setTitle('Archivo Estatal');

$spreadsheet->setActiveSheetIndex(0);

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $NombreFile . '"');
header('Cache-Control: max-age=0');

$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
